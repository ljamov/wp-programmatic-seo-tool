<?php
namespace Programmatic_SEO_Tool;

class REST_API {
    public static function init() {
        add_action('rest_api_init', [__CLASS__, 'register_routes']);
    }

    public static function register_routes() {
        register_rest_route('seo-tool/v1', '/analyze', [
            'methods'  => 'GET',
            'callback' => [__CLASS__, 'handle_request'],
            'permission_callback' => function () {
                return current_user_can('edit_posts'); // Only allow authenticated users
            },
        ]);
    }

    public static function handle_request($request) {
        $keyword = $request->get_param('keyword');
        if (empty($keyword)) {
            return new \WP_Error('no_keyword', 'Please provide a keyword.', ['status' => 400]);
        }

        $analyzer = new SEO_Analyzer($keyword);
        $results = $analyzer->analyze_posts();

        return rest_ensure_response($results);
    }
}