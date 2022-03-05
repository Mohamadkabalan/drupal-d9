<?php

namespace Drupal\url_alias_permissions;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides dynamic permissions for the url_alias_permissions module.
 */
class UrlAliasPermPermissions implements ContainerInjectionInterface {

  use StringTranslationTrait;

  /**
   * The entity field manager.
   *
   * @var \Drupal\Core\Entity\EntityFieldManagerInterface
   */
  protected $entityFieldManager;

  /**
   * The entity type bundle info.
   *
   * @var \Drupal\Core\Entity\EntityTypeBundleInfoInterface
   */
  protected $entityTypeBundleInfo;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a UrlAliasPermPermissions instance.
   *
   * @param \Drupal\Core\Entity\EntityFieldManagerInterface $entity_field_manager
   *   The entity field manager.
   * @param \Drupal\Core\Entity\EntityTypeBundleInfoInterface $entity_type_bundle_info
   *   The entity type bundle info.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(EntityFieldManagerInterface $entity_field_manager, EntityTypeBundleInfoInterface $entity_type_bundle_info, EntityTypeManagerInterface $entity_type_manager) {
    $this->entityFieldManager = $entity_field_manager;
    $this->entityTypeBundleInfo = $entity_type_bundle_info;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_field.manager'),
      $container->get('entity_type.bundle.info'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * Returns an array of URL alias permissions.
   *
   * @return array
   *   An array of permissions.
   */
  public function urlAliasPermissions(): array {
    $permissions = [];

    $bundle_info = $this->entityTypeBundleInfo->getAllBundleInfo();
    // Create an edit url alias permissions for each enabled entity type and
    // (optionally) bundle.
    foreach ($this->entityFieldManager->getFieldMapByFieldType('path') as $entity_type_id => $fields) {
      $entity_type = $this->entityTypeManager->getDefinition($entity_type_id);
      if (!$entity_type instanceof EntityTypeInterface) {
        continue;
      }

      $t_args = ['@entity_label' => $entity_type->getSingularLabel()];

      switch ($entity_type->getPermissionGranularity()) {
        case 'bundle':
          foreach ($fields['path']['bundles'] as $bundle_id) {
            $t_args['%bundle_label'] = $bundle_info[$entity_type_id][$bundle_id]['label'];
            $permissions["edit $bundle_id $entity_type_id url alias"] = [
              'title' => $this->t('Create and edit %bundle_label @entity_label URL alias', $t_args),
            ];
          }
          break;

        case 'entity_type':
          $permissions["edit $entity_type_id url alias"] = [
            'title' => $this->t('Create and edit @entity_label URL alias', $t_args),
          ];
          break;
      }
    }

    return $permissions;
  }

}
