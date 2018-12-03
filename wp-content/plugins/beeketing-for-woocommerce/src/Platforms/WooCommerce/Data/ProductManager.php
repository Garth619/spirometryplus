<?php
/**
 * User: Quan Truong
 * Email: quan@beeketing.com
 * Date: 8/13/18
 * Time: 4:20 PM
 */

namespace BeeketingConnect_beeketing_woocommerce\Platforms\WooCommerce\Data;


use BeeketingConnect_beeketing_woocommerce\Common\Constants as CommonConstants;
use BeeketingConnect_beeketing_woocommerce\Common\Data\Manager\ProductManagerAbstract;
use BeeketingConnect_beeketing_woocommerce\Common\Data\Model\Count;
use BeeketingConnect_beeketing_woocommerce\Common\Data\Model\Image;
use BeeketingConnect_beeketing_woocommerce\Common\Data\Model\Product;
use BeeketingConnect_beeketing_woocommerce\Platforms\WooCommerce\DataManager\QueryHelper;
use BeeketingConnect_beeketing_woocommerce\Platforms\WooCommerce\Helper;

class ProductManager extends ProductManagerAbstract
{

    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * @var VariantManager
     */
    private $variantManager;

    private $wcProducts = array();
    private $prePopulateData = false;
    private $wcProductImages = array();
    private $wcImageByProducts = array();
    private $wcProductTags = array();
    private $wcCollectionIds = array();
    private $permalinks = array();

    /**
     * @var ResourceManager
     */
    private $resourceManager;

    /**
     * OrderManager constructor.
     * @param ResourceManager $resourceManager
     */
    public function __construct(ResourceManager $resourceManager)
    {
        $this->resourceManager = $resourceManager;
    }

    /**
     * Get product
     * @param $arg
     * @return Product
     */
    public function get($arg)
    {
        $id = $arg['resource_id'];

        global $wpdb;
        $result = $wpdb->get_row(
            $wpdb->prepare(
                "
                SELECT *
                FROM $wpdb->posts
                WHERE post_type = %s
                  AND post_status = %s
                  AND post_password = %s
                  AND ID = %d
                ",
                "product",
                "publish",
                null,
                $id
            )
        );

        $product = $result ? $this->formatProduct($result) : false;

        return $product;
    }

    /**
     * Get product
     * @param $arg
     * @return Product[]
     */
    public function getMany($arg)
    {
        $page = $arg['page'];
        $limit = $arg['limit'];
        $title = $arg['title'];

        $offset = ($page - 1) * $limit;

        global $wpdb;
        $result = $wpdb->get_results(
            $wpdb->prepare(
                "
                SELECT *
                FROM $wpdb->posts
                WHERE post_type = %s
                  AND post_status = %s
                  AND post_password = %s
                  AND post_title LIKE %s
                  AND ID NOT IN ( " . QueryHelper::getExcludeProductsId() . " )
                LIMIT %d
                OFFSET %d
                ",
                "product",
                "publish",
                null,
                "%" . $title . "%",
                $limit,
                $offset
            )
        );

        $products = $ids = array();
        // Traverse all result
        foreach ($result as $item) {
            $ids[] = $item->ID;
        }

        // Fill wc products
        $this->getWCProducts($ids);

        // Fill product images
        $this->wcProductImages = $this->getProductImages($ids);

        // Fill product tags
        $this->getProductTags($ids);

        // Fill product collections
        $this->getProductCollections($ids);

        // Fill option1
        $option1s = $this->getOption1s();
        $this->resourceManager->variantManager->setOption1s($option1s);

        // Fill permalinks
        $this->permalinks = get_option('woocommerce_permalinks');

        // Mark pre populate data
        $this->prePopulateData = true;

        // Traverse all result
        foreach ($result as $item) {
            $products[] = $this->formatProduct($item);
        }

        return $products;
    }

    /**
     * Count products
     * @return Count
     */
    public function count()
    {
        global $wpdb;
        $count = $wpdb->get_var(
            $wpdb->prepare(
                "
                SELECT COUNT(ID)
                FROM $wpdb->posts
                WHERE post_type = %s
                  AND post_status = %s
                  AND post_password = %s
                  AND ID NOT IN ( " . QueryHelper::getExcludeProductsId() . " )
                ",
                "product",
                "publish",
                null
            )
        );

        return new Count($count);
    }

    /**
     * Update product
     * @param $arg
     * @return Product
     */
    public function put($arg)
    {
        $id = $arg['resource_id'];
        $productData = $arg['product'];
        $tags = isset($productData['tags']) ? explode(',', $productData['tags']) : array();

        $product_tags = array();
        foreach ($tags as $tag) {
            if ($tag) {
                $args = array(
                    'hide_empty' => false,
                    'fields' => 'ids',
                    'name' => $tag
                );

                $tagIds = get_terms('product_tag', $args);

                if (!$tagIds) {
                    $defaults = array(
                        'name' => $tag,
                        'slug' => sanitize_title($tag),
                    );

                    $insert = wp_insert_term($defaults['name'], 'product_tag', $defaults);
                    $id = $insert['term_id'];
                    $product_tags[] = $id;

                } else {
                    $product_tags = array_merge($product_tags, $tagIds);

                }
            }
        }

        // Update tag
        if ($product_tags) {
            wp_set_object_terms($id, $product_tags, 'product_tag');
        }

        return $this->get(array(
            'resource_id' => $id,
        ));
    }

    /**
     * Format product
     *
     * @param $product
     * @return Product
     */
    private function formatProduct($product)
    {
        $productBase = isset($this->permalinks['product_base']) && $this->permalinks['product_base'] ?
            ltrim($this->permalinks['product_base'], '/') : null;

        $productId = $product->ID;
        $post = $product;
        $wcProduct = isset($this->wcProducts[$productId]) ? $this->wcProducts[$productId] : wc_get_product($productId);
        if ($this->prePopulateData) {
            $tags = isset($this->wcProductTags[$productId]) ? $this->wcProductTags[$productId] : array();
        } else {
            $tags = wp_get_post_terms($productId, 'product_tag', array('fields' => 'names'));
        }

        if (isset($this->wcProductImages[$productId]) && $this->wcProductImages[$productId]) {
            $images = $this->wcProductImages[$productId];

            // Sorting image
            $imagesInOrder = array();
            if (isset($this->wcImageByProducts[$productId])) {
                $imagesList = $this->wcImageByProducts[$productId];
                sort($imagesList);
                foreach ($imagesList as $image) {
                    if (is_array($image)) {
                        foreach ($image as $img) {
                            $imagesInOrder[] = $img;
                        }
                    } else {
                        $imagesInOrder[] = $image;
                    }
                }
            }

            if ($imagesInOrder) {
                usort($images, function ($imgA, $imgB) use ($imagesInOrder) {
                    if ($imgA->id && $imgB->id) {
                        $aOrder = array_search($imgA->id, $imagesInOrder);
                        $bOrder = array_search($imgB->id, $imagesInOrder);

                        return $aOrder > $bOrder ? 1 : -1;
                    }

                    return 0;
                });
            }
        } else {
            $images = $this->resourceManager->imageManager->getProductImagesByWCProduct($wcProduct);
        }

        if (!$productBase || preg_match('/%.*%/', $productBase)) {
            $productHandle = ltrim(str_replace(get_site_url(), '', $wcProduct->get_permalink()), '/');
        } else {
            $productBase = preg_replace('/%.*%/', '', $productBase);
            $productBase = rtrim($productBase, '/');
            $productHandle = $productBase . '/' . $post->post_name;
        }

        // Get variants
        $variants = $this->resourceManager->variantManager->getVariantsByProduct($wcProduct);

        // Get variants images
        $variantsImages = $this->resourceManager->variantManager->getVariantsImages($variants);

        // Prevent duplicate image id
        foreach ($images as $img) {
            if (isset($variantsImages[$img->id])) {
                unset($variantsImages[$img->id]);
            }
        }

        if ($variantsImages) {
            $images = array_merge($images, array_values($variantsImages));
        }

        // Get product collection ids
        if (isset($this->wcCollectionIds[$productId]) && $this->wcCollectionIds[$productId]) {
            $collectionIds = $this->wcCollectionIds[$productId];
        } else {
            $collectionIds = wp_get_post_terms($productId, 'product_cat', array('fields' => 'ids'));
            $collectionIds = $collectionIds ? array_map('intval', $collectionIds) : array();
        }

        $product = new Product();
        $product->id = (int)$productId;
        $product->published_at = $post->post_date_gmt;
        $product->handle = $productHandle;
        $product->title = $post->post_title;
        $product->vendor = '';
        $product->tags = $tags ? implode('; ', $tags) : '';
        $product->description = $post->post_excerpt;
        $product->images = $images;
        $product->image = (isset($images[0]) && $images[0]->src) ? $images[0]->src : '';
        $product->variants = $variants;
        $product->collection_ids = $collectionIds;

        // Currently, just support 2 statuses: in_stock, out_of_stock.
        $product->stock_status = $wcProduct->is_in_stock()
            ? CommonConstants::STOCK_STATUS_IN_STOCK
            : CommonConstants::STOCK_STATUS_OUT_OF_STOCK;

        return $product;
    }

    /**
     * Get wc products
     *
     * @param $postsId
     */
    private function getWCProducts($postsId)
    {
        if (!Helper::isWc3()) {
            return;
        }

        $wcProducts = wc_get_products(array(
            'include' => $postsId,
            'limit' => -1,
        ));

        $parentProductIds = array();
        /** @var \WC_Product $wcProduct */
        foreach ($wcProducts as $wcProduct) {
            $product_id = $wcProduct->get_id();
            $this->wcProducts[$product_id] = $wcProduct;

            if (!$wcProduct->is_type('simple')) {
                $parentProductIds[] = $wcProduct->get_id();
            }
        }

        if ($parentProductIds) {
            $args = array(
                'post_parent__in' => $parentProductIds,
                'post_type' => 'product_variation',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'fields' => 'ids',
                'post_status' => 'publish',
                'numberposts' => -1
            );
            $variantIds = get_posts($args);

            if ($variantIds) {
                $wcVariants = wc_get_products(array(
                    'type' => 'variation',
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'include' => $variantIds,
                    'limit' => -1,
                ));

                $wcProductsVariants = array();
                /** @var \WC_Product_Variation $wcVariant */
                foreach ($wcVariants as $wcVariant) {
                    $wcProductsVariants[$wcVariant->get_parent_id()][] = $wcVariant;
                }

                // Store all variants of a list product
                $this->resourceManager->variantManager->setWCProductsVariants($wcProductsVariants);

                // Store all images of variants of a list product
                $this->resourceManager->variantManager->setWCProductsVariantsImages($this->getProductImages($variantIds));
            }
        }
    }

    /**
     * Get product images
     *
     * @param $postsId
     * @return array
     */
    private function getProductImages($postsId)
    {
        global $wpdb;

        $data = array();
        if (!$postsId) {
            return $data;
        }

        // Get all images id
        $imageResult = $wpdb->get_results(
            "
            SELECT post_id, meta_key, meta_value
            FROM $wpdb->postmeta
            WHERE post_id IN (" . implode(',', $postsId) . ") AND meta_key IN ('_thumbnail_id', '_product_image_gallery')
            "
        );

        $imagesRelation = array();
        $imagesId = array();
        foreach ($imageResult as $item) {
            if ($item->meta_key == '_product_image_gallery') {
                $imagesIdList = explode(',', $item->meta_value);
                $this->wcImageByProducts[$item->post_id][1] = $imagesIdList;
                foreach ($imagesIdList as $imageId) {
                    if ($imageId) {
                        $imagesId[] = $imageId;
                        $imagesRelation[$imageId] = $item->post_id;
                    }
                }
            } else {
                $this->wcImageByProducts[$item->post_id][0] = $item->meta_value;
                $imagesId[] = $item->meta_value;
                $imagesRelation[$item->meta_value] = $item->post_id;
            }
        }

        $imagesId = array_filter(array_unique($imagesId));
        if ($imagesId) {
            // Integrate with WP-Stateless plugin
            $smMode = strtolower(get_option('sm_mode'));
            $isUseGCS = ($smMode === 'cdn' || $smMode === 'stateless');

            $result = $wpdb->get_results(
                "
                SELECT p.ID, p.post_parent, pm.meta_key, pm.meta_value
                FROM $wpdb->postmeta pm JOIN $wpdb->posts p ON pm.post_id = p.ID
                WHERE pm.meta_key IN ('_wp_attached_file', '_wp_attachment_metadata'" . ($isUseGCS ? ", 'sm_cloud'" : "") . ")
                  AND p.post_type = 'attachment'
                  AND p.ID IN (" . implode(',', $imagesId) . ")
                "
            );

            $imagesConverted = array();
            foreach ($result as $item) {
                $imagesConverted[$item->ID]['post_parent'] = $item->post_parent;
                $imagesConverted[$item->ID][$item->meta_key] = $item->meta_value;
            }

            foreach ($imagesConverted as $imageId => $imageConverted) {
                // Get medium image
                $file = null;

                // Integrate with WP-Stateless plugin
                $sm_cloud = ($isUseGCS && isset($imageConverted['sm_cloud'])) ? unserialize($imageConverted['sm_cloud']) : null;

                if (isset($imageConverted['_wp_attachment_metadata'])) {
                    $image = $imageConverted['_wp_attachment_metadata'];
                    $image = unserialize($image);
                    $sizes = array('medium', 'shop_catalog', 'thumbnail', 'shop_thumbnail');

                    foreach ($sizes as $size) {
                        if (isset($image['sizes'][$size]['file'])) {
                            // Integrate with WP-Stateless plugin
                            if (is_array($sm_cloud) && !empty($sm_cloud['sizes'][$size]['fileLink'])) {
                                $file = apply_filters('wp_stateless_bucket_link', $sm_cloud['sizes'][$size]['fileLink']);
                                break;
                            }

                            $file = $image['sizes'][$size]['file'];
                            $image = $image['file'];
                            $file = preg_replace('/[^\/]+$/', $file, $image);

                            break;
                        }
                    }
                }

                // Fall back to main image
                if (!$file) {
                    // Integrate with WP-Stateless plugin
                    if (is_array($sm_cloud) && !empty($sm_cloud['fileLink'])) {
                        $file = apply_filters('wp_stateless_bucket_link', $sm_cloud['fileLink']);
                    } else {
                        $file = $imageConverted['_wp_attached_file'];
                    }
                }

                // Get upload directory.
                $url = null;
                $isUseS3 = strpos($file, 's3://') !== false;
                if (preg_match_all('/^http(s)?:\/\//', $file) == 1 || $isUseS3) { // If image use cdn
                    $url = $file;
                    // if use s3 short tag
                    if ($isUseS3) {
                        $url = str_replace('s3://', 'https://s3.amazonaws.com/', $file);
                    }
                } else { // Local image
                    if (function_exists('wp_get_upload_dir') && ($uploads = wp_get_upload_dir()) && false === $uploads['error']) {
                        // Check that the upload base exists in the file location.
                        if (0 === strpos($file, $uploads['basedir'])) {
                            // Replace file location with url location.
                            $url = str_replace($uploads['basedir'], $uploads['baseurl'], $file);
                        } else {
                            // It's a newly-uploaded file, therefore $file is relative to the basedir.
                            $url = $uploads['baseurl'] . "/$file";
                        }
                    }
                }

                // Ignore image
                if (!$url) {
                    continue;
                }

                $postParent = isset($imagesRelation[$imageId]) ? $imagesRelation[$imageId] : $imageConverted['post_parent'];

                $image = new Image();
                $image->id = (int)$imageId;
                $image->src = $url;

                $data[$postParent][] = $image;
            }
        }

        return $data;
    }

    /**
     * Get product tags
     *
     * @param $postsId
     */
    private function getProductTags($postsId)
    {
        global $wpdb;

        if (!$postsId) {
            return;
        }

        // Get all images id
        $tagResult = $wpdb->get_results(
            "
            SELECT t.name, tr.object_id
            FROM $wpdb->terms t JOIN $wpdb->term_taxonomy tt ON t.term_id = tt.term_id
            JOIN $wpdb->term_relationships tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
            WHERE tr.object_id IN (" . implode(',', $postsId) . ") AND tt.taxonomy = 'product_tag'
            "
        );

        foreach ($tagResult as $item) {
            $this->wcProductTags[$item->object_id][] = $item->name;
        }
    }

    /**
     * Get product collection ids
     *
     * @param $postIds
     */
    private function getProductCollections($postIds)
    {
        global $wpdb;

        if (!$postIds) {
            return;
        }

        // Get all collection ids
        $collectionResult = $wpdb->get_results(
            "
            SELECT GROUP_CONCAT(tr.term_taxonomy_id) as collection_ids, tr.object_id
            FROM $wpdb->terms t JOIN $wpdb->term_taxonomy tt ON t.term_id = tt.term_id
            JOIN $wpdb->term_relationships tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
            WHERE tr.object_id IN (" . implode(',', $postIds) . ") AND tt.taxonomy = 'product_cat'
            GROUP BY tr.object_id
            "
        );

        if (count($collectionResult) == 0) {
            return;
        }

        foreach ($collectionResult as $item) {
            $collectionIds = explode(',', (string)$item->collection_ids);
            $this->wcCollectionIds[$item->object_id] = $collectionIds ? array_map('intval', $collectionIds) : array();
        }
    }

    /**
     * Get options1s
     *
     * @return array
     */
    public function getOption1s()
    {
        global $wpdb;
        $results = $wpdb->get_results(
            "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '_beeketing_option1'"
        );

        $option1s = array();
        foreach ($results as $result) {
            $option1s[$result->post_id] = $result->meta_value;
        }
        return $option1s;
    }

}
