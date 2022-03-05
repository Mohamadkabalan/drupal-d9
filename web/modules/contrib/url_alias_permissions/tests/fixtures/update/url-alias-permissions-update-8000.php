<?php

// @codingStandardsIgnoreFile

/**
 * @file
 * Contains database additions to drupal-8.8.0.bare.standard.php.gz.
 */

use Drupal\Core\Database\Database;
use Drupal\Core\Serialization\Yaml;
use Drupal\field\Entity\FieldStorageConfig;

$connection = Database::getConnection();

// Add 8000 as the latest installed hook_update_N.
$connection->insert('key_value')
  ->fields([
    'collection',
    'name',
    'value',
  ])
  ->values([
    'collection' => 'system.schema',
    'name' => 'url_alias_permissions',
    'value' => 'i:8000;',
  ])
  ->execute();

// Update core.extension. Add url_alias_permissions module.
$extensions = $connection->select('config')
  ->fields('config', ['data'])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute()
  ->fetchField();
$extensions = unserialize($extensions);
$extensions['module']['url_alias_permissions'] = 0;
$connection->update('config')
  ->fields([
    'data' => serialize($extensions),
  ])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute();

// Add "edit article URL alias" permission to authenticated user.
$role = $connection->select('config')
  ->fields('config', ['data'])
  ->condition('collection', '')
  ->condition('name', 'user.role.authenticated')
  ->execute()
  ->fetchField();
$role = unserialize($role);
$role['permissions'][] = 'edit article URL alias';
$connection->update('config')
  ->fields([
    'data' => serialize($role),
  ])
  ->condition('collection', '')
  ->condition('name', 'user.role.authenticated')
  ->execute();

// Add "edit article URL alias" and "edit page URL alias" permissions to
// the anonymous role.
$role = $connection->select('config')
  ->fields('config', ['data'])
  ->condition('collection', '')
  ->condition('name', 'user.role.anonymous')
  ->execute()
  ->fetchField();
$role = unserialize($role);
$role['permissions'][] = 'edit article URL alias';
$role['permissions'][] = 'edit page URL alias';
$connection->update('config')
  ->fields([
    'data' => serialize($role),
  ])
  ->condition('collection', '')
  ->condition('name', 'user.role.anonymous')
  ->execute();
