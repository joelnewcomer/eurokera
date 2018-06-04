<?php

namespace WPGDPRC\Includes;

/**
 * Class Action
 * @package WPGDPRC\Includes
 */
class Action {
    /** @var null */
    private static $instance = null;

    public function showAdminNotices() {
        if (isset($_REQUEST['notice'])) {
            $dismissible = true;
            $type = 'info';
            $message = '';
            switch ($_REQUEST['notice']) {
                case 'wpgdprc-consent-updated' :
                    $type = 'success';
                    $message = __('Consent has been updated successfully.', WP_GDPR_C_SLUG);
                    break;
                case 'wpgdprc-consent-added' :
                    $type = 'success';
                    $message = __('Consent has been added successfully.', WP_GDPR_C_SLUG);
                    break;
                case 'wpgdprc-consent-not-found' :
                    $type = 'error';
                    $message = __('Couldn\'t find this consent.', WP_GDPR_C_SLUG);
                    break;
            }
            if (!empty($message)) {
                printf(
                    '<div class="notice notice-%s %s"><p>%s</p></div>',
                    $type,
                    (($dismissible) ? 'is-dismissible' : ''),
                    $message
                );
            }
        }
    }

    /**
     * Stop WordPress from sending anything but essential data during the update check
     * @param array $query
     * @return array
     */
    public function onlySendEssentialDataDuringUpdateCheck($query = array()) {
        unset($query['php']);
        unset($query['mysql']);
        unset($query['local_package']);
        unset($query['blogs']);
        unset($query['users']);
        unset($query['multisite_enabled']);
        unset($query['initial_db_version']);
        return $query;
    }

    public function processEnableAccessRequest() {
        $enabled = Helper::isEnabled('enable_access_request', 'settings');
        if ($enabled) {
            $accessRequest = AccessRequest::databaseTableExists();
            $deleteRequest = DeleteRequest::databaseTableExists();
            if (!$accessRequest || !$deleteRequest) {
                Helper::createUserRequestDataTables();
                $result = wp_insert_post(array(
                    'post_type' => 'page',
                    'post_status' => 'private',
                    'post_title' => __('Data Access Request', WP_GDPR_C_SLUG),
                    'post_content' => '[wpgdprc_access_request_form]',
                    'meta_input' => array(
                        '_wpgdprc_access_request' => 1,
                    ),
                ), true);
                if (!is_wp_error($result)) {
                    update_option(WP_GDPR_C_PREFIX . '_settings_access_request_page', $result);
                }
            }
        }
    }

    public function processToggleAccessRequest() {
        $page = Helper::getAccessRequestPage();
        if (!empty($page)) {
            $enabled = Helper::isEnabled('enable_access_request', 'settings');
            $status = ($enabled) ? 'private' : 'draft';
            wp_update_post(array(
                'ID' => $page->ID,
                'post_status' => $status
            ));
        }
    }

    public function showNoticesRequestUserData() {
        $enabled = Helper::isEnabled('enable_access_request', 'settings');
        if ($enabled) {
            $accessRequest = AccessRequest::databaseTableExists();
            $deleteRequest = DeleteRequest::databaseTableExists();
            if (!$accessRequest || !$deleteRequest) {
                $pluginData = Helper::getPluginData();
                printf(
                    '<div class="%s"><p><strong>%s:</strong> %s %s</p></div>',
                    'notice notice-error',
                    $pluginData['Name'],
                    __('Couldn\'t create the required database tables.', WP_GDPR_C_SLUG),
                    sprintf(
                        '<a class="button" href="%s">%s</a>',
                        Helper::getPluginAdminUrl('', array('wpgdprc-action' => 'create_request_tables')),
                        __('Retry', WP_GDPR_C_SLUG)
                    )
                );
            }
        }
    }

    public function addConsentBar() {
        $output = '<div class="wpgdprc wpgdprc-consent-bar">';
        $output .= '<div class="wpgdprc-consent-bar__container">';
        $output .= '<div class="wpgdprc-consent-bar__content">';
        $output .= '<div class="wpgdprc-consent-bar__column">';
        $output .= '<div class="wpgdprc-consent-bar__notice">';
        $output .= apply_filters('the_content', Consent::getBarExplanationText());
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="wpgdprc-consent-bar__column">';
        $output .= sprintf(
            '<a class="wpgdprc-consent-bar__settings" href="javascript:void(0);" data-micromodal-trigger="wpgdprc-consent-modal">%s</a>',
            esc_attr__('My settings', WP_GDPR_C_SLUG)
        );
        $output .= '</div>';
        $output .= '<div class="wpgdprc-consent-bar__column">';
        $output .= sprintf(
            '<button class="wpgdprc-button wpgdprc-consent-bar__button">%s</button>',
            __('Accept', WP_GDPR_C_SLUG)
        );
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        echo apply_filters('wpgdprc_consent_bar', $output);
    }

    public function addConsentModal() {
        $consents = Consent::getInstance()->getList(array(
            'active' => array('value' => 1)
        ));
        $output = '<div class="wpgdprc wpgdprc-consent-modal" id="wpgdprc-consent-modal" aria-hidden="true">';
        $output .= '<div class="wpgdprc-consent-modal__overlay" tabindex="-1" data-micromodal-close>';
        $output .= '<div class="wpgdprc-consent-modal__container" role="dialog" aria-modal="true">';
        if (!empty($consents)) {
            $output .= '<nav class="wpgdprc-consent-modal__navigation">';
            /** @var Consent $consent */
            foreach ($consents as $consent) {
                $output .= sprintf(
                    '<a class="wpgdprc-button" href="javascript:void(0);" data-target="%d">%s</a>',
                    $consent->getId(),
                    $consent->getTitle()
                );
            }
            $output .= '</nav>'; // .wpgdprc-consent-modal__navigation
            $output .= '<div class="wpgdprc-consent-modal__information">';
            $output .= '<div class="wpgdprc-consent-modal__description">';
            $output .= sprintf(
                '<h3 class="wpgdprc-consent-modal__title">%s</h3>',
                Consent::getModalTitle()
            );
            $output .= apply_filters('the_content', Consent::getModalExplanationText());
            $output .= apply_filters('the_content', sprintf(
                '<strong>%s:</strong> %s',
                strtoupper(__('Note', WP_GDPR_C_SLUG)),
                __('These settings will only apply to the browser and device you are currently using.', WP_GDPR_C_SLUG)
            ));
            $output .= '</div>'; // .wpgdprc-consent-modal__description
            /** @var Consent $consent */
            foreach ($consents as $consent) {
                $output .= sprintf(
                    '<div class="wpgdprc-consent-modal__description" style="display: none;" data-target="%d">',
                    $consent->getId()
                );
                $output .= sprintf('<h3 class="wpgdprc-consent-modal__title">%s</h3>', $consent->getTitle());
                $output .= apply_filters('the_content', $consent->getDescription());
                $output .= '<div class="wpgdprc-checkbox">';
                $output .= '<label>';
                $output .= sprintf(
                    '<input type="checkbox" value="%d" tabindex="1" />',
                    $consent->getId()
                );
                $output .= '<span class="wpgdprc-switch" aria-hidden="true">';
                $output .= '<span class="wpgdprc-switch-label">';
                $output .= '<span class="wpgdprc-switch-inner"></span>';
                $output .= '<span class="wpgdprc-switch-switch"></span>';
                $output .= '</span>';
                $output .= '</span>';
                $output .= ' Enable</label>';
                $output .= '</div>';
                $output .= '</div>'; // .wpgdprc-consent-modal__description
            }
            $output .= '<footer class="wpgdprc-consent-modal__footer">';
            $output .= sprintf(
                '<a class="wpgdprc-button wpgdprc-button--secondary" href="javascript:void(0);">%s</a>',
                __('Save my settings', WP_GDPR_C_SLUG)
            );
            $output .= '</footer>'; // .wpgdprc-consent-modal__footer
            $output .= '</div>'; // .wpgdprc-consent-modal__information
        }
        $output .= sprintf(
            '<button class="wpgdprc-consent-modal__close" aria-label="%s" data-micromodal-close>&#x2715;</button>',
            esc_attr__('Close modal', WP_GDPR_C_SLUG)
        );
        $output .= '</div>'; // .wpgdprc-consent-modal__container
        $output .= '</div>'; // .wpgdprc-consent-modal__overlay
        $output .= '</div>'; // #wpgdprc-consent-modal
        echo $output;
    }

    public function addConsentsToHead() {
        $consentIds = Helper::getConsentIdsByCookie();
        if ($consentIds === false) {
            return;
        }
        $args = array(
            'active' => array('value' => 1),
            'placement' => array('value' => 'head'),
        );
        if (!empty($consentIds)) {
            $args['ID'] = array(
                'value' => $consentIds,
                'compare' => 'IN'
            );
        }
        $consents = Consent::getInstance()->getList($args);
        echo Consent::output($consents);
    }

    public function addConsentsToFooter() {
        $consentIds = Helper::getConsentIdsByCookie();
        if ($consentIds === false) {
            return;
        }
        $args = array(
            'active' => array('value' => 1),
            'placement' => array('value' => 'footer')
        );
        if (!empty($consentIds)) {
            $args['ID'] = array(
                'value' => $consentIds,
                'compare' => 'IN'
            );
        }
        $consents = Consent::getInstance()->getList($args);
        echo Consent::output($consents);
    }

    /**
     * @return null|Action
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}