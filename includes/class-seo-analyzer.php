<?php
namespace Programmatic_SEO_Tool;

class SEO_Analyzer {
    private $keyword;

    public function __construct($keyword) {
        $this->keyword = $keyword;
    }

    public function analyze_posts() {
        $args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        ];
        $posts = get_posts($args);
        $results = [];

        foreach ($posts as $post) {
            $content = strip_tags($post->post_content);
            $word_count = str_word_count($content);
            $keyword_count = substr_count(strtolower($content), strtolower($this->keyword));
            $keyword_density = ($keyword_count / $word_count) * 100;

            $results[] = [
                'post_id'         => $post->ID,
                'post_title'      => $post->post_title,
                'word_count'      => $word_count,
                'keyword_density' => round($keyword_density, 2),
            ];
        }

        return $results;
    }
}