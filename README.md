# Programmatic SEO Tool

**Contributors:** Kristijan Ljamov  
**Tags:** seo, analysis, wordpress  
**Requires at least:** 5.0  
**Tested up to:** 6.0  
**Stable tag:** 1.0  

A WordPress tool for programmatic SEO analysis of published posts.

---

## Description

This plugin analyzes published posts for word count and keyword density, displays the results in a sortable and filterable table, and provides a REST API endpoint for JSON data.

---

## Installation

1. Upload the `programmatic-seo-tool` folder to the `wp-content/plugins` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

---

## Usage

1. Go to **SEO Analysis** under the WordPress Admin Dashboard.
2. Enter a keyword and click **Analyze** to view the results.
3. Access the REST API endpoint at:
   ```
   /wp-json/seo-tool/v1/analyze?keyword=your-keyword
   ```

---

## Changelog

### 1.0
- Initial release.
