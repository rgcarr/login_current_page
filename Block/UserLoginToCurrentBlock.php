<?php

declare(strict_types=1);

namespace Drupal\login_current_page\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Url;

/**
 * Provides an user login to current block.
 */
#[Block(
  id: 'login_current_page_user_login_to_current',
  admin_label: new TranslatableMarkup('User Login to Current'),
  category: new TranslatableMarkup('Custom'),
)]
final class UserLoginToCurrentBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $url = Url::fromRoute('user.login', [], ['query' => \Drupal::service('redirect.destination')->getAsArray()]);
    $login_link = Link::fromTextAndUrl('Login', $url);
    $login_link = $login_link->toRenderable();
    $link_attributes = [
      'class' => ['login-link'],
      'title' => t("Login to your user account or request new password"),
    ];
    $login_link['#attributes'] = $link_attributes;

    $build['login_link'] = $login_link;

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    // Force no caching of this block.
    return 0;
  }

}
