# Revizion

Revizion is a Wordpress plugin that allows visitors of a Wordpress site to explore past versions of a post and compare different versions of a post dynamically, directly from the post's page.

- [wordpress plugins](https://wordpress.org/plugins/about/)
- [google-diff-match-patch](https://code.google.com/p/google-diff-match-patch/)
- [vue.js](http://vuejs.org/)
- [vue-cli](https://github.com/vuejs/vue-cli) and [vue-loader](http://vue-loader.vuejs.org/en/index.html) with [simple webpack template](https://github.com/vuejs-templates/webpack-simple)

## About

Visitors of a Wordpress blog post can navigate to past versions of the post. They can compare differences between two versions of the post (additions and removals). It works for any two versions of the post: consecutive versions, first vs. last version or even backward comparisons (e.g. changes from v5 to v1).

The controls blend in with the Wordpress theme, between the post header and post content for easy and localized access. They can be pinned to remain on a fixed location of the page when the user scrolls to the bottom of a long post (to be done).

## Installation

Install from the [Wordpress Plugin Directory](https://wordpress.org/plugins/) (coming soon...)

or

Download this repository and copy it into the ```wp-content/plugins``` directory of your Wordpress site.

Activate the Revizion plugin in the plugins section of your Wordpress admin site

## Development

### Work on the project

``` bash
git clone git@github.com:Willooz/revizion.git
# clone this repository
# Wordpress/PHP functions in revizion.php
# Vue.js/js application in /src folder (development) and /dist folder (deployment)

npm install
# install js dependencies

npm run dev
# serve with hot reload at localhost:8080

npm run build
# build for production with minification
```

### Understand the project

What the plugin does is...

In Worpress (revizion.php):
- replace post content with an <app> tag that contains all post revisions in json format.
- include diff_patch_match.js diffing functions and build.js app in the page.

In the browser (build.js):
- mount a Vue.js **App** on the <app> tag.

The **App** consists of:
- a **Controls** component that displays version sliders and controls which post versions are to be compared,
- a **Content** component that computes version differences (calling diff_patch_match) and displays diffed content.

## Author

Willem Browne

## License

[GNUGPLv3](http://www.gnu.org/licenses/gpl.html)
