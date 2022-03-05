# Themeing with Devvly's custom theme
The theme files should be found in `web/themes`.

Be sure to review the [Getting Started with Drupal 8](https://docs.google.com/document/d/16Hv_3z3ZAL2BmLi6wfQnw1vd6k3hv-JiWsW2IXAukL8/edit?usp=sharing) Google doc.

## Base Theme
Devvlybase is Devvly’s custom base theme that provides a default starting point for the primary theme. The base theme should be rarely if ever be edited. All work should be done in the subtheme.

## Subtheme
The subtheme is found in that same folder and inherits the base themes configuration. If it’s a new site it’s called d8starter if it’s an existing site it will have been renamed to match the project. This is where all custom development occurs. You can do the frontend in one of the two Devvly approved methods.

- [Foundation 6 XY grid](https://get.foundation/sites/docs/xy-grid.html) - If you are more comfortable with a CSS framework you can use Foundation. It’s installed by default when you run npm install and you can configure the settings in `sass/_settings.scss`. By default only core styles like buttons, forms, headings and grid are included. However all [Foundation mixins](https://get.foundation/sites/docs/sass-mixins.html) are included and can be used . You can find more options to include or exclude styles in `sass/_foundation.scss`
- **Simple** - You can also remove Foundation and just use CSS Grid and Flexbox to layout the site as needed. This is the preferred method as it is lightweight and allows each featured to be custom coded to its necessary layout rather than forcing it into a grid. However using Foundation is perfectly acceptable solution.
    - Flexbox Cheatsheet - http://flexbox.malven.co/
    - CSS Grid Cheatsheet - http://grid.malven.co/
    - Free Video Tutorials
        - https://cssgrid.io/
        - https://flexbox.io/

> Bootstrap is not a Devvly approved framework and should not be used. Foundation should be used if a css framework is needed or desired. This is to maintain consistency as all Devvly sites are built on Foundation.

### SASS
Sass should be used for all CSS styling. A default example.gulpfile.js file has already been configured. Copy it to gulpfile.js and make any needed tweaks for your local environment.

- Inside the subtheme run `npm install`
- To build once run `gulp style`
- To have it watch your files and build automatically run `gulp watch`
- To exit gulp watch type `control + c`

#### Gulp Mode
Gulp mode is included to allow conditional pipes in a task. By default sourcesmaps will only be generated if you run.

`gulp style --dev` or `gulp watch --dev`

By default it generates prod css without sourcemaps so be sure to run just one of these commands before you commit your css changes to make sure sourcemaps are excluded as it will save almost 1mb in size in the file.

`gulp style` Or `gulp style --prod`

### Font Awesome 5 Pro
We have a Font Awesome 5 Pro license and it is included via npm as well and will be installed when you run `npm install`. Solid and Brands are included by default in `sass/style.scss` but other styles can be included by uncommeting the import line in style.scss.
https://fontawesome.com


## Setting up a new theme
If you are setting a new project and you are starting it off of the [Devvly Drupal 8 Starter repo](https://gitlab.com/devvly-projects/drupal-8-starter) you will need to make some changes.
- Rename the folder name to something similar to the project. For instance if the site is for Amazon, rename the folder from `d8starter` to `amazon`.
- Do the same for the files `d8starter.info.yml`, `d8starter.theme` and `d8starter.libraries.yml`, They should match the folder name like `amazon.info.yml`,  `amazon.theme` and `amazon.libraries.yml`.
- In `amazon.info.yml` rename the theme in LINE 1 accordingly
- In `amazon.info.yml` rename the library to the theme name in LINE 23 from ` - subtheme/global-styling` to ` - amazon/global-styling`
- Rename the functions in `d8starter.theme` that start with `d8starter_` to the theme name like `amazon_`
- Now you can log in and set your new theme as the default theme.
