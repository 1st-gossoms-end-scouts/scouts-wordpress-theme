/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var el = wp.element.createElement;
var withSelect = wp.data.withSelect;
var withDispatch = wp.data.withDispatch;
var SelectControl = wp.components.SelectControl;
var _wp$components = wp.components,
    Button = _wp$components.Button,
    Spinner = _wp$components.Spinner,
    BaseControl = _wp$components.BaseControl;
var _wp$blockEditor = wp.blockEditor,
    MediaUpload = _wp$blockEditor.MediaUpload,
    MediaUploadCheck = _wp$blockEditor.MediaUploadCheck;
var _wp$data = wp.data,
    useSelect = _wp$data.useSelect,
    useDispatch = _wp$data.useDispatch;


wp.hooks.addFilter('editor.PostFeaturedImage', 'enhance-featured-image/align-featured-image-control', wrapPostFeaturedImage);

function wrapPostFeaturedImage(OriginalComponent) {
    return function (props) {
        return el(wp.element.Fragment, {}, el(OriginalComponent, props), el(composedSelectControl), el(ImageControl));
    };
}

var SelectControlCustom = function (_React$Component) {
    _inherits(SelectControlCustom, _React$Component);

    function SelectControlCustom() {
        _classCallCheck(this, SelectControlCustom);

        return _possibleConstructorReturn(this, (SelectControlCustom.__proto__ || Object.getPrototypeOf(SelectControlCustom)).apply(this, arguments));
    }

    _createClass(SelectControlCustom, [{
        key: 'render',
        value: function render() {
            var _this2 = this;

            var _props = this.props,
                meta = _props.meta,
                updateFeaturedImage = _props.updateFeaturedImage;


            return el(wp.components.SelectControl, {
                heading: "Manage Featured Image",
                label: "Set Position",
                help: "Set vertical alignment for featured image",
                value: meta.align_featured_image,
                options: [{ value: 'top', label: 'Top' }, { value: 'center', label: 'Center' }, { value: 'bottom', label: 'Bottom' }],
                onChange: function onChange(value) {
                    _this2.setState({ alignment: value });
                    updateFeaturedImage(value, meta);
                }
            });
        }
    }]);

    return SelectControlCustom;
}(React.Component);

var composedSelectControl = wp.compose.compose([withSelect(function (select) {
    var currentMeta = select('core/editor').getCurrentPostAttribute('meta');
    var editedMeta = select('core/editor').getEditedPostAttribute('meta');
    return {
        meta: _extends({}, currentMeta, editedMeta)
    };
}), withDispatch(function (dispatch) {
    return {
        updateFeaturedImage: function updateFeaturedImage(value, meta) {
            meta = _extends({}, meta, {
                align_featured_image: value
            });
            dispatch('core/editor').editPost({ meta: meta });
        }
    };
})])(SelectControlCustom);

var ImageControl = function ImageControl() {
    var _useSelect = useSelect(function (select) {

        var id = select('core/editor').getEditedPostAttribute('meta')['logo_image'];
        return {
            imageId: id,
            image: select('core').getMedia(id)
        };
    }),
        imageId = _useSelect.imageId,
        image = _useSelect.image;

    var _useDispatch = useDispatch('core/editor', [imageId]),
        editPost = _useDispatch.editPost;

    return wp.element.createElement(
        BaseControl,
        { id: 'logo_image', label: "Logo", help: '(Optional) Upload a logo in place of the title' },
        wp.element.createElement(
            MediaUploadCheck,
            null,
            wp.element.createElement(MediaUpload, {
                onSelect: function onSelect(media) {
                    return editPost({ meta: _defineProperty({}, 'logo_image', media.id) });
                },
                allowedTypes: ['image'],
                value: imageId,
                render: function render(_ref) {
                    var open = _ref.open;
                    return wp.element.createElement(
                        'div',
                        null,
                        !imageId && wp.element.createElement(
                            Button,
                            { variant: 'secondary', onClick: open },
                            'Upload image'
                        ),
                        !!imageId && !image && wp.element.createElement(Spinner, null),
                        !!image && image && wp.element.createElement(
                            Button,
                            { variant: 'link', onClick: open },
                            wp.element.createElement('img', { src: image.source_url })
                        )
                    );
                }
            })
        ),
        !!imageId && wp.element.createElement(
            Button,
            { onClick: function onClick() {
                    return editPost({ meta: _defineProperty({}, "logo_image", null) });
                }, isLink: true, isDestructive: true },
            'Remove image'
        )
    );
};

/***/ })
/******/ ]);