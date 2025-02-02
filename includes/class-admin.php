<?php
namespace Programmatic_SEO_Tool;

class Admin {
    public static function init() {
        add_action('admin_menu', [__CLASS__, 'add_admin_menu']);
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
    }
    

    public static function add_admin_menu() {
        add_menu_page(
            'SEO Analysis', // Page title
            'SEO Analysis', // Menu title
            'manage_options', // Capability
            'seo-analysis', // Menu slug
            [__CLASS__, 'render_admin_page'], // Callback function
            'dashicons-chart-bar', // Icon
            6 // Position
        );
    }

    public static function render_admin_page() {
        $keyword = isset($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : '';
        $results = [];

        if (!empty($keyword)) {
            $analyzer = new \Programmatic_SEO_Tool\SEO_Analyzer($keyword); // Ensure correct namespace
            $results = $analyzer->analyze_posts();
        }

        ?>
        <div class="seo-analysis-wrap">
            <h1 class="seo-analysis-title">SEO Analysis</h1>

            <form method="get" action="<?php echo admin_url('admin.php'); ?>" class="seo-analysis-form">
                <input type="hidden" name="page" value="seo-analysis">
                <label for="keyword">Enter Keyword:</label>
                <input type="text" id="keyword" name="keyword" value="<?php echo esc_attr($keyword); ?>">
                <button type="submit" class="button button-primary">Analyze</button>
            </form>

            <?php if (!empty($results)) : ?>
                <table id="seo-analysis-table" class="wp-list-table widefat fixed striped tablesorter seo-analysis-table">
                    <thead>
                        <tr>
                            <th data-sorter="text">Post Title</th>
                            <th data-sorter="digit">Word Count</th>
                            <th data-sorter="digit">Keyword Density (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result) : ?>
                            <tr>
                                <td><?php echo esc_html($result['post_title']); ?></td>
                                <td><?php echo esc_html($result['word_count']); ?></td>
                                <td><?php echo esc_html($result['keyword_density']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <?php
    }

    public static function enqueue_assets() {
        // Enqueue CSS
        wp_enqueue_style('seo-tool-css', plugin_dir_url(dirname(__FILE__)) . 'assets/css/seo-tool.css', [], '1.0.0');

        // Enqueue jQuery (already included in WordPress)
        wp_enqueue_script('jquery');

        // Enqueue Tablesorter JavaScript
        wp_enqueue_script('tablesorter', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js', ['jquery'], '2.31.3', true);

        // Enqueue custom JavaScript for initialization
        wp_enqueue_script('seo-tool-js', plugin_dir_url(dirname(__FILE__)) . 'assets/js/seo-tool.js', ['jquery', 'tablesorter'], '1.0.0', true);
    }
}
