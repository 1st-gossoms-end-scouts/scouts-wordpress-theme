# Scouts Wordpress Theme

Scouts Wordpress Theme is designed for UK scout groups to easily design a wordpress site that follows the UK Scout Association Brand guidelines

It is a simple, Gutenberg-compatible theme loaded with Bootstrap 5 — using node-sass for preprocessing its SCSS into CSS.
It is based on the [b5st](https://github.com/SimonPadbury/b5st) theme.

A demo of the site is available at [wordpress-theme.1stgossomsendscouts.org.uk](https://wordpress-theme.1stgossomsendscouts.org.uk)

## Contributing

This theme is actively under development. Any and all contributions are encouraged - please raise an issue and accompanying pull request should you wish.

## Installing the theme

This theme provides plugin functionality in order to simplify install.
However, this is against the guidance of wordpress.org, and therefore cannot be installed through their theme store.
Eventually this functionality may be moved to a required plugin.

To install the theme, download the zip file from [here](https://github.com/1st-gossoms-end-scouts/scouts-wordpress-theme/releases), and upload it to your site in the admin console.

## Dependencies
WordPress v6.0+

### For development (see “Preprocessing SCSS Files” below):

- NodeJS
- node-sass

## Preprocessing SCSS Files

In the `theme/` folder there is a `scss/` folder containing all the SCSS files that have been used to create the file `theme/css/b5st.css`.

You can (beautify and) edit `b5st.css` directly — or you can preprocess the SCSS files using whatever you prefer to use. A simple way is to do the following:

1. Install this theme into your WordPress (local) development environment.

2. Download and install [NodeJS](https://nodejs.org/), if you don’t have it already. It's recommended to use node version manager here, see [https://github.com/nvm-sh/nvm](https://github.com/nvm-sh/nvm)

3. In your terminal, `cd` into the `scouts-wordpress-theme` folder. Just do `npm install` so that `node-sass` gets installed as a dev dependancy (see the b5st `package.json`).

4. You can then run `node-sass` in the terminal using `npm run scss`, and stop it using `ctrl+C`. `node-sass` will look for changes in SCSS files inside the `theme/scss` folder and output the CSS file(s) in the `theme/css` folder.

5. Your WordPress (local) development server likely has no live-refresh for when CSS files are modified in this way. So, manually do a browser refresh ↻ whenever you want to see your CSS changes.

---

## Acknowledgments
Simon Padbury for the [b5st](https://github.com/SimonPadbury/b5st) repo

Jack Furby's [Bootscout theme](https://github.com/JackFurby/Bootscout-theme), which provided inspiration for this project

The UK Scout Association for the design and brand guidelines

## License

This software is licensed under [GNU General Public License v3.0](LICENSE.md)
