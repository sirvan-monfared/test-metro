(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_front_AuthMenu_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=script&lang=js":
/*!********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=script&lang=js ***!
  \********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _routes__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../routes */ "./resources/js/routes.js");
/* harmony import */ var _composables_useClickOutside__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../composables/useClickOutside */ "./resources/js/composables/useClickOutside.js");



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: {
    user: {
      required: true
    }
  },
  setup: function setup(props) {
    var _toRefs = (0,vue__WEBPACK_IMPORTED_MODULE_0__.toRefs)(props),
        user = _toRefs.user;

    var isVisible = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(false);
    var dropdown_menu = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var csrf = document.head.querySelector('meta[name="csrf-token"]').content;
    (0,_composables_useClickOutside__WEBPACK_IMPORTED_MODULE_2__["default"])(dropdown_menu, function () {
      isVisible.value = false;
    });

    var toggle = function toggle() {
      isVisible.value = !isVisible.value;
    };

    return {
      route: _routes__WEBPACK_IMPORTED_MODULE_1__.route,
      toggle: toggle,
      csrf: csrf,
      user: user,
      isVisible: isVisible,
      dropdown_menu: dropdown_menu
    };
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=template&id=5148c8f8&scoped=true":
/*!************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=template&id=5148c8f8&scoped=true ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-5148c8f8"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};

var _hoisted_1 = {
  ref: "dropdown_menu",
  "class": "relative"
};
var _hoisted_2 = ["src"];

var _hoisted_3 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 24 24",
    "stroke-width": "1.5",
    stroke: "currentColor",
    "class": "w-3 h-3"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    d: "M19.5 8.25l-7.5 7.5-7.5-7.5"
  })], -1
  /* HOISTED */
  );
});

var _hoisted_4 = ["href"];

var _hoisted_5 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "flex items-center gap-1"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 24 24",
    "stroke-width": "1.5",
    stroke: "currentColor",
    "class": "w-5 h-5 stroke-yellow-500"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    d: "M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0"
  })]), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "font-medium"
  }, "امتیازها: ")], -1
  /* HOISTED */
  );
});

var _hoisted_6 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "w-full border-b border-dashed border-gray-300"
  }, null, -1
  /* HOISTED */
  );
});

var _hoisted_7 = ["href"];

var _hoisted_8 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 24 24",
    "stroke-width": "1.5",
    stroke: "currentColor",
    "class": "w-6 h-6"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    d: "M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"
  })], -1
  /* HOISTED */
  );
});

var _hoisted_9 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "font-medium"
  }, "پیشخوان", -1
  /* HOISTED */
  );
});

var _hoisted_10 = [_hoisted_8, _hoisted_9];
var _hoisted_11 = ["href"];

var _hoisted_12 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-6 w-6\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" stroke-width=\"1.5\" data-v-5148c8f8><path d=\"M12 14l9-5-9-5-9 5 9 5z\" data-v-5148c8f8></path><path d=\"M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z\" data-v-5148c8f8></path><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222\" data-v-5148c8f8></path></svg><span class=\"font-medium\" data-v-5148c8f8> دوره های من</span>", 2);

var _hoisted_14 = [_hoisted_12];
var _hoisted_15 = ["href"];

var _hoisted_16 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 24 24",
    "stroke-width": "1.5",
    stroke: "currentColor",
    "class": "w-6 h-6"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    d: "M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"
  })], -1
  /* HOISTED */
  );
});

var _hoisted_17 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "font-medium"
  }, "سفارش های من", -1
  /* HOISTED */
  );
});

var _hoisted_18 = [_hoisted_16, _hoisted_17];
var _hoisted_19 = ["action"];
var _hoisted_20 = ["value"];

var _hoisted_21 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "flex items-center gap-2 px-3 py-2 text-gray-500 text-sm hover:bg-gray-200"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    "class": "h-6 w-6",
    fill: "none",
    viewBox: "0 0 24 24",
    stroke: "currentColor",
    "stroke-width": "1.5"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    d: "M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
  })]), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "submit",
    "class": "item channel_item logout-btn font-medium"
  }, "خروج")], -1
  /* HOISTED */
  );
});

function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: "javascript:",
    onClick: _cache[0] || (_cache[0] = function () {
      return $setup.toggle && $setup.toggle.apply($setup, arguments);
    }),
    "class": "flex items-center gap-2"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    src: $setup.user.avatar,
    alt: "avatar",
    "class": "w-10 h-10 bg-white shadow-md rounded-full border-2 border-white"
  }, null, 8
  /* PROPS */
  , _hoisted_2), _hoisted_3]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["absolute left-0 bg-white shadow-md z-10 top-9 min-w-max", {
      'block': $setup.isVisible,
      'hidden': !$setup.isVisible
    }])
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: $setup.route('dashboard.point.index'),
    "class": "flex items-center justify-between px-3 py-2 text-gray-500 text-sm hover:bg-gray-200"
  }, [_hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.user.xp_points), 1
  /* TEXT */
  )], 8
  /* PROPS */
  , _hoisted_4), _hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: $setup.route('dashboard'),
    "class": "flex items-center gap-2 px-3 py-2 text-gray-500 text-sm hover:bg-gray-200"
  }, [].concat(_hoisted_10), 8
  /* PROPS */
  , _hoisted_7), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: $setup.route('dashboard.course.index'),
    "class": "flex items-center gap-2 px-3 py-2 text-gray-500 text-sm hover:bg-gray-200"
  }, [].concat(_hoisted_14), 8
  /* PROPS */
  , _hoisted_11), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: $setup.route('dashboard.order.history'),
    "class": "flex items-center gap-2 px-3 py-2 text-gray-500 text-sm hover:bg-gray-200"
  }, [].concat(_hoisted_18), 8
  /* PROPS */
  , _hoisted_15), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", {
    method: "POST",
    action: $setup.route('logout'),
    "class": "item channel_item"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "hidden",
    name: "_token",
    value: $setup.csrf
  }, null, 8
  /* PROPS */
  , _hoisted_20), _hoisted_21], 8
  /* PROPS */
  , _hoisted_19)], 2
  /* CLASS */
  )], 512
  /* NEED_PATCH */
  );
}

/***/ }),

/***/ "./resources/js/composables/useClickOutside.js":
/*!*****************************************************!*\
  !*** ./resources/js/composables/useClickOutside.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ useClickOutside)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

function useClickOutside(target_ref, callback) {
  if (!target_ref) return null;

  var listener = function listener(e) {
    if (e.target == target_ref.value || e.composedPath().includes(target_ref.value)) {
      return;
    }

    if (typeof callback === 'function') {
      callback();
    }
  };

  (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
    window.addEventListener('click', listener);
  });
  (0,vue__WEBPACK_IMPORTED_MODULE_0__.onBeforeUnmount)(function () {
    window.removeEventListener('click', listener);
  });
  return {
    listener: listener
  };
}

/***/ }),

/***/ "./resources/js/routes.js":
/*!********************************!*\
  !*** ./resources/js/routes.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "route": () => (/* binding */ route)
/* harmony export */ });
/* provided dependency */ var process = __webpack_require__(/*! process/browser.js */ "./node_modules/process/browser.js");
var routes = {
  "sanctum.csrf-cookie": {
    "uri": "sanctum\/csrf-cookie"
  },
  "livewire.message": {
    "uri": "livewire\/message\/{name}"
  },
  "livewire.message-localized": {
    "uri": "{locale}\/livewire\/message\/{name}"
  },
  "livewire.upload-file": {
    "uri": "livewire\/upload-file"
  },
  "livewire.preview-file": {
    "uri": "livewire\/preview-file\/{filename}"
  },
  "ignition.healthCheck": {
    "uri": "_ignition\/health-check"
  },
  "ignition.executeSolution": {
    "uri": "_ignition\/execute-solution"
  },
  "ignition.updateConfig": {
    "uri": "_ignition\/update-config"
  },
  "front.home": {
    "uri": "\/"
  },
  "front.about": {
    "uri": "about"
  },
  "course.list": {
    "uri": "courses"
  },
  "course.show": {
    "uri": "course\/{course}"
  },
  "category.show": {
    "uri": "category\/{category}"
  },
  "cart.show": {
    "uri": "cart\/show"
  },
  "cart.item.add": {
    "uri": "cart\/{course}\/add"
  },
  "cart.item.remove": {
    "uri": "cart\/{course}\/remove"
  },
  "cart.checkout": {
    "uri": "cart\/checkout"
  },
  "gateway.start": {
    "uri": "pay\/{order}\/start"
  },
  "gateway.callback": {
    "uri": "pay\/callback"
  },
  "gateway.checkout": {
    "uri": "pay\/{order}\/checkout"
  },
  "gateway.disabled": {
    "uri": "pay\/{order}\/no-gateway"
  },
  "otp.form": {
    "uri": "verify-otp"
  },
  "front.blog": {
    "uri": "blog"
  },
  "front.blog.show": {
    "uri": "blog\/{post}"
  },
  "front.podcast": {
    "uri": "podcast"
  },
  "front.podcast.show": {
    "uri": "podcast\/{podcast}"
  },
  "tag.show": {
    "uri": "tag\/{tag}"
  },
  "api.post.comment.index": {
    "uri": "api\/post\/{post}\/comment"
  },
  "api.post.comment.store": {
    "uri": "api\/post\/{post}\/comment"
  },
  "api.course.comment.index": {
    "uri": "api\/course\/{course}\/comment"
  },
  "api.course.comment.store": {
    "uri": "api\/course\/{course}\/comment"
  },
  "api.course.comment.info": {
    "uri": "api\/course\/{course}\/comment\/info"
  },
  "api.podcast.comment.index": {
    "uri": "api\/podcast\/{podcast}\/comment"
  },
  "api.podcast.comment.store": {
    "uri": "api\/podcast\/{podcast}\/comment"
  },
  "api.wheel.prizes": {
    "uri": "api\/wheel\/yalda-1402"
  },
  "api.wheel.rotate": {
    "uri": "api\/wheel\/yalda-1402"
  },
  "login": {
    "uri": "login"
  },
  "password.request": {
    "uri": "forgot-password"
  },
  "password.email": {
    "uri": "forgot-password"
  },
  "password.reset": {
    "uri": "reset-password\/{token}"
  },
  "password.update": {
    "uri": "reset-password"
  },
  "verification.verify": {
    "uri": "verify-email\/{id}\/{hash}"
  },
  "logout": {
    "uri": "logout"
  },
  "dashboard": {
    "uri": "dashboard"
  },
  "dashboard.course.index": {
    "uri": "dashboard\/course"
  },
  "dashboard.course": {
    "uri": "dashboard\/course\/{course}"
  },
  "dashboard.course.exercise.create": {
    "uri": "dashboard\/course\/{course}\/exercise\/create"
  },
  "dashboard.course.exercise.store": {
    "uri": "dashboard\/course\/{course}\/exercise"
  },
  "dashboard.course.exercise.upload": {
    "uri": "dashboard\/course\/{course}\/exercise\/upload"
  },
  "dashboard.exercise.show": {
    "uri": "dashboard\/course\/exercise\/{exercise}"
  },
  "dashboard.order.history": {
    "uri": "dashboard\/payment\/history"
  },
  "dashboard.order.show": {
    "uri": "dashboard\/payment\/{order}"
  },
  "dashboard.profile.edit": {
    "uri": "dashboard\/profile\/edit"
  },
  "dashboard.profile.update": {
    "uri": "dashboard\/profile"
  },
  "dashboard.profile.editName": {
    "uri": "dashboard\/profile\/edit-name"
  },
  "dashboard.profile.updateName": {
    "uri": "dashboard\/profile\/edit-name"
  },
  "dashboard.point.index": {
    "uri": "dashboard\/points"
  },
  "dashboard.apikey.index": {
    "uri": "dashboard\/apikey"
  },
  "dashboard.apikey.store": {
    "uri": "dashboard\/apikey"
  },
  "admin.dashboard": {
    "uri": "lara-admin"
  },
  "admin.lesson.index": {
    "uri": "lara-admin\/lesson"
  },
  "admin.lesson.create": {
    "uri": "lara-admin\/lesson\/create"
  },
  "admin.lesson.store": {
    "uri": "lara-admin\/lesson"
  },
  "admin.lesson.edit": {
    "uri": "lara-admin\/lesson\/{lesson}\/edit"
  },
  "admin.lesson.update": {
    "uri": "lara-admin\/lesson\/{lesson}"
  },
  "admin.lesson.destroy": {
    "uri": "lara-admin\/lesson\/{lesson}"
  },
  "admin.lesson.course": {
    "uri": "lara-admin\/lesson\/course\/{course}"
  },
  "admin.user.index": {
    "uri": "lara-admin\/user"
  },
  "admin.user.create": {
    "uri": "lara-admin\/user\/create"
  },
  "admin.user.store": {
    "uri": "lara-admin\/user"
  },
  "admin.user.show": {
    "uri": "lara-admin\/user\/{user}"
  },
  "admin.user.edit": {
    "uri": "lara-admin\/user\/{user}\/edit"
  },
  "admin.user.update": {
    "uri": "lara-admin\/user\/{user}"
  },
  "admin.enrollment.index": {
    "uri": "lara-admin\/enrollment"
  },
  "admin.enrollment.create": {
    "uri": "lara-admin\/enrollment\/create"
  },
  "admin.enrollment.store": {
    "uri": "lara-admin\/enrollment"
  },
  "admin.enrollment.show": {
    "uri": "lara-admin\/enrollment\/{enrollment}"
  },
  "admin.sitemap.generate": {
    "uri": "lara-admin\/sitemap\/generate"
  },
  "admin.course.index": {
    "uri": "lara-admin\/course"
  },
  "admin.course.create": {
    "uri": "lara-admin\/course\/create"
  },
  "admin.course.store": {
    "uri": "lara-admin\/course"
  },
  "admin.course.edit": {
    "uri": "lara-admin\/course\/{course}\/edit"
  },
  "admin.course.update": {
    "uri": "lara-admin\/course\/{course}"
  },
  "admin.post.index": {
    "uri": "lara-admin\/post"
  },
  "admin.post.create": {
    "uri": "lara-admin\/post\/create"
  },
  "admin.post.store": {
    "uri": "lara-admin\/post"
  },
  "admin.post.edit": {
    "uri": "lara-admin\/post\/{post}\/edit"
  },
  "admin.post.update": {
    "uri": "lara-admin\/post\/{post}"
  },
  "admin.post.destroy": {
    "uri": "lara-admin\/post\/{post}"
  },
  "admin.podcast.index": {
    "uri": "lara-admin\/podcast"
  },
  "admin.podcast.create": {
    "uri": "lara-admin\/podcast\/create"
  },
  "admin.podcast.store": {
    "uri": "lara-admin\/podcast"
  },
  "admin.podcast.edit": {
    "uri": "lara-admin\/podcast\/{podcast}\/edit"
  },
  "admin.podcast.update": {
    "uri": "lara-admin\/podcast\/{podcast}"
  },
  "admin.podcast.destroy": {
    "uri": "lara-admin\/podcast\/{podcast}"
  },
  "admin.comment.index": {
    "uri": "lara-admin\/comment"
  },
  "admin.comment.create": {
    "uri": "lara-admin\/comment\/create"
  },
  "admin.comment.store": {
    "uri": "lara-admin\/comment"
  },
  "admin.comment.show": {
    "uri": "lara-admin\/comment\/{comment}"
  },
  "admin.comment.edit": {
    "uri": "lara-admin\/comment\/{comment}\/edit"
  },
  "admin.comment.update": {
    "uri": "lara-admin\/comment\/{comment}"
  },
  "admin.comment.destroy": {
    "uri": "lara-admin\/comment\/{comment}"
  },
  "admin.post.comment.index": {
    "uri": "lara-admin\/post\/{post}\/comment"
  },
  "admin.course.comment.index": {
    "uri": "lara-admin\/course\/{course}\/comment"
  },
  "admin.podcast.comment.index": {
    "uri": "lara-admin\/podcast\/{podcast}\/comment"
  },
  "admin.report.income": {
    "uri": "lara-admin\/report\/income"
  },
  "admin.report.user-register": {
    "uri": "lara-admin\/report\/user-register"
  },
  "admin.points.index": {
    "uri": "lara-admin\/points"
  },
  "admin.points.create": {
    "uri": "lara-admin\/points\/create"
  },
  "admin.points.store": {
    "uri": "lara-admin\/points"
  },
  "admin.achievement.create": {
    "uri": "lara-admin\/points\/achievement\/create"
  },
  "admin.achievement.store": {
    "uri": "lara-admin\/points\/achievement"
  },
  "admin.exercise.index": {
    "uri": "lara-admin\/exercise"
  },
  "admin.exercise.create": {
    "uri": "lara-admin\/exercise\/create"
  },
  "admin.exercise.store": {
    "uri": "lara-admin\/exercise"
  },
  "admin.exercise.show": {
    "uri": "lara-admin\/exercise\/{exercise}"
  },
  "admin.exercise.edit": {
    "uri": "lara-admin\/exercise\/{exercise}\/edit"
  },
  "admin.exercise.update": {
    "uri": "lara-admin\/exercise\/{exercise}"
  },
  "admin.exercise.destroy": {
    "uri": "lara-admin\/exercise\/{exercise}"
  },
  "admin.file.download": {
    "uri": "lara-admin\/file\/{file}\/download"
  },
  "admin.order.index": {
    "uri": "lara-admin\/order"
  },
  "admin.order.show": {
    "uri": "lara-admin\/order\/{order}"
  },
  "admin.coupon.index": {
    "uri": "lara-admin\/coupon"
  },
  "admin.coupon.create": {
    "uri": "lara-admin\/coupon\/create"
  },
  "admin.coupon.store": {
    "uri": "lara-admin\/coupon"
  },
  "admin.coupon.show": {
    "uri": "lara-admin\/coupon\/{coupon}"
  },
  "admin.coupon.edit": {
    "uri": "lara-admin\/coupon\/{coupon}\/edit"
  },
  "admin.coupon.update": {
    "uri": "lara-admin\/coupon\/{coupon}"
  },
  "admin.coupon.destroy": {
    "uri": "lara-admin\/coupon\/{coupon}"
  },
  "admin.api.users": {
    "uri": "lara-admin\/api\/users"
  },
  "admin.api.upload": {
    "uri": "lara-admin\/api\/upload"
  },
  "cart.coupon.apply": {
    "uri": "api\/cart\/coupon"
  },
  "api.auth.check_username": {
    "uri": "api\/authenticate"
  },
  "api.auth.login": {
    "uri": "api\/authenticate\/login"
  },
  "api.otp.resend": {
    "uri": "api\/authenticate\/otp\/resend"
  },
  "api.otp.verify": {
    "uri": "api\/authenticate\/otp\/verify"
  },
  "api.forgot.check": {
    "uri": "api\/authenticate\/forgot-password"
  },
  "api.forgot.verify_otp": {
    "uri": "api\/authenticate\/forgot-password\/verify-otp"
  },
  "api.password.reset": {
    "uri": "api\/authenticate\/reset-password"
  }
};

var route = function route(routeName) {
  var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
  var absolute = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
  var _route = routes[routeName];
  if (_route == null) throw "Requested route doesn't exist";
  var uri = _route.uri;
  var matches = uri.match(/{[\w]+\??}/g) || [];
  var optionals = uri.match(/{[\w]+\?}/g) || [];
  var requiredParametersCount = matches.length - optionals.length;

  if (params instanceof Array) {
    if (params.length < requiredParametersCount) throw "Missing parameters";

    for (var i = 0; i < requiredParametersCount; i++) {
      uri = uri.replace(/{[\w]+\??}/, params.shift());
    }

    for (var _i = 0; _i < params.length; _i++) {
      uri += (_i ? "&" : "?") + params[_i] + "=" + params[_i];
    }
  } else if (params instanceof Object) {
    var extraParams = matches.reduce(function (ac, match) {
      var key = match.substring(1, match.length - 1);
      var isOptional = key.endsWith("?");

      if (params.hasOwnProperty(key.replace("?", ""))) {
        uri = uri.replace(new RegExp(match.replace("?", "\\?"), "g"), params[key.replace("?", "")]);
        delete ac[key.replace("?", "")];
      } else if (isOptional) {
        uri = uri.replace("/" + new RegExp(match, "g"), "");
      }

      return ac;
    }, params);
    Object.keys(extraParams).forEach(function (key, i) {
      uri += (i ? "&" : "?") + key + "=" + extraParams[key];
    });
  }

  if (optionals.length > 0) {
    for (var _i2 in optionals) {
      uri = uri.replace("/" + optionals[_i2], "");
    }
  }

  if (uri.includes("}")) throw "Missing parameters";
  if (absolute && process.env.MIX_APP_URL) return process.env.MIX_APP_URL + "/" + uri;
  return "/" + uri;
};



/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.menu.dropdown_account.visible[data-v-5148c8f8] {\r\n    display: block !important;\n}\n.menu.dropdown_account.hidden[data-v-5148c8f8] {\r\n    display: none !important;\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/api.js":
/*!*****************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/api.js ***!
  \*****************************************************/
/***/ ((module) => {

"use strict";


/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
// eslint-disable-next-line func-names
module.exports = function (cssWithMappingToString) {
  var list = []; // return the list of modules as css string

  list.toString = function toString() {
    return this.map(function (item) {
      var content = cssWithMappingToString(item);

      if (item[2]) {
        return "@media ".concat(item[2], " {").concat(content, "}");
      }

      return content;
    }).join("");
  }; // import a list of modules into the list
  // eslint-disable-next-line func-names


  list.i = function (modules, mediaQuery, dedupe) {
    if (typeof modules === "string") {
      // eslint-disable-next-line no-param-reassign
      modules = [[null, modules, ""]];
    }

    var alreadyImportedModules = {};

    if (dedupe) {
      for (var i = 0; i < this.length; i++) {
        // eslint-disable-next-line prefer-destructuring
        var id = this[i][0];

        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }

    for (var _i = 0; _i < modules.length; _i++) {
      var item = [].concat(modules[_i]);

      if (dedupe && alreadyImportedModules[item[0]]) {
        // eslint-disable-next-line no-continue
        continue;
      }

      if (mediaQuery) {
        if (!item[2]) {
          item[2] = mediaQuery;
        } else {
          item[2] = "".concat(mediaQuery, " and ").concat(item[2]);
        }
      }

      list.push(item);
    }
  };

  return list;
};

/***/ }),

/***/ "./node_modules/process/browser.js":
/*!*****************************************!*\
  !*** ./node_modules/process/browser.js ***!
  \*****************************************/
/***/ ((module) => {

// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_10_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_10_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AuthMenu_vue_vue_type_style_index_0_id_5148c8f8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_10_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_10_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AuthMenu_vue_vue_type_style_index_0_id_5148c8f8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_10_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_10_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AuthMenu_vue_vue_type_style_index_0_id_5148c8f8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/*!****************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \****************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var isOldIE = function isOldIE() {
  var memo;
  return function memorize() {
    if (typeof memo === 'undefined') {
      // Test for IE <= 9 as proposed by Browserhacks
      // @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
      // Tests for existence of standard globals is to allow style-loader
      // to operate correctly into non-standard environments
      // @see https://github.com/webpack-contrib/style-loader/issues/177
      memo = Boolean(window && document && document.all && !window.atob);
    }

    return memo;
  };
}();

var getTarget = function getTarget() {
  var memo = {};
  return function memorize(target) {
    if (typeof memo[target] === 'undefined') {
      var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself

      if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
        try {
          // This will throw an exception if access to iframe is blocked
          // due to cross-origin restrictions
          styleTarget = styleTarget.contentDocument.head;
        } catch (e) {
          // istanbul ignore next
          styleTarget = null;
        }
      }

      memo[target] = styleTarget;
    }

    return memo[target];
  };
}();

var stylesInDom = [];

function getIndexByIdentifier(identifier) {
  var result = -1;

  for (var i = 0; i < stylesInDom.length; i++) {
    if (stylesInDom[i].identifier === identifier) {
      result = i;
      break;
    }
  }

  return result;
}

function modulesToDom(list, options) {
  var idCountMap = {};
  var identifiers = [];

  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var count = idCountMap[id] || 0;
    var identifier = "".concat(id, " ").concat(count);
    idCountMap[id] = count + 1;
    var index = getIndexByIdentifier(identifier);
    var obj = {
      css: item[1],
      media: item[2],
      sourceMap: item[3]
    };

    if (index !== -1) {
      stylesInDom[index].references++;
      stylesInDom[index].updater(obj);
    } else {
      stylesInDom.push({
        identifier: identifier,
        updater: addStyle(obj, options),
        references: 1
      });
    }

    identifiers.push(identifier);
  }

  return identifiers;
}

function insertStyleElement(options) {
  var style = document.createElement('style');
  var attributes = options.attributes || {};

  if (typeof attributes.nonce === 'undefined') {
    var nonce =  true ? __webpack_require__.nc : 0;

    if (nonce) {
      attributes.nonce = nonce;
    }
  }

  Object.keys(attributes).forEach(function (key) {
    style.setAttribute(key, attributes[key]);
  });

  if (typeof options.insert === 'function') {
    options.insert(style);
  } else {
    var target = getTarget(options.insert || 'head');

    if (!target) {
      throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
    }

    target.appendChild(style);
  }

  return style;
}

function removeStyleElement(style) {
  // istanbul ignore if
  if (style.parentNode === null) {
    return false;
  }

  style.parentNode.removeChild(style);
}
/* istanbul ignore next  */


var replaceText = function replaceText() {
  var textStore = [];
  return function replace(index, replacement) {
    textStore[index] = replacement;
    return textStore.filter(Boolean).join('\n');
  };
}();

function applyToSingletonTag(style, index, remove, obj) {
  var css = remove ? '' : obj.media ? "@media ".concat(obj.media, " {").concat(obj.css, "}") : obj.css; // For old IE

  /* istanbul ignore if  */

  if (style.styleSheet) {
    style.styleSheet.cssText = replaceText(index, css);
  } else {
    var cssNode = document.createTextNode(css);
    var childNodes = style.childNodes;

    if (childNodes[index]) {
      style.removeChild(childNodes[index]);
    }

    if (childNodes.length) {
      style.insertBefore(cssNode, childNodes[index]);
    } else {
      style.appendChild(cssNode);
    }
  }
}

function applyToTag(style, options, obj) {
  var css = obj.css;
  var media = obj.media;
  var sourceMap = obj.sourceMap;

  if (media) {
    style.setAttribute('media', media);
  } else {
    style.removeAttribute('media');
  }

  if (sourceMap && typeof btoa !== 'undefined') {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  } // For old IE

  /* istanbul ignore if  */


  if (style.styleSheet) {
    style.styleSheet.cssText = css;
  } else {
    while (style.firstChild) {
      style.removeChild(style.firstChild);
    }

    style.appendChild(document.createTextNode(css));
  }
}

var singleton = null;
var singletonCounter = 0;

function addStyle(obj, options) {
  var style;
  var update;
  var remove;

  if (options.singleton) {
    var styleIndex = singletonCounter++;
    style = singleton || (singleton = insertStyleElement(options));
    update = applyToSingletonTag.bind(null, style, styleIndex, false);
    remove = applyToSingletonTag.bind(null, style, styleIndex, true);
  } else {
    style = insertStyleElement(options);
    update = applyToTag.bind(null, style, options);

    remove = function remove() {
      removeStyleElement(style);
    };
  }

  update(obj);
  return function updateStyle(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap) {
        return;
      }

      update(obj = newObj);
    } else {
      remove();
    }
  };
}

module.exports = function (list, options) {
  options = options || {}; // Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
  // tags it will allow on a page

  if (!options.singleton && typeof options.singleton !== 'boolean') {
    options.singleton = isOldIE();
  }

  list = list || [];
  var lastIdentifiers = modulesToDom(list, options);
  return function update(newList) {
    newList = newList || [];

    if (Object.prototype.toString.call(newList) !== '[object Array]') {
      return;
    }

    for (var i = 0; i < lastIdentifiers.length; i++) {
      var identifier = lastIdentifiers[i];
      var index = getIndexByIdentifier(identifier);
      stylesInDom[index].references--;
    }

    var newLastIdentifiers = modulesToDom(newList, options);

    for (var _i = 0; _i < lastIdentifiers.length; _i++) {
      var _identifier = lastIdentifiers[_i];

      var _index = getIndexByIdentifier(_identifier);

      if (stylesInDom[_index].references === 0) {
        stylesInDom[_index].updater();

        stylesInDom.splice(_index, 1);
      }
    }

    lastIdentifiers = newLastIdentifiers;
  };
};

/***/ }),

/***/ "./node_modules/vue-loader/dist/exportHelper.js":
/*!******************************************************!*\
  !*** ./node_modules/vue-loader/dist/exportHelper.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
// runtime helper for setting properties on components
// in a tree-shakable way
exports["default"] = (sfc, props) => {
    const target = sfc.__vccOpts || sfc;
    for (const [key, val] of props) {
        target[key] = val;
    }
    return target;
};


/***/ }),

/***/ "./resources/js/components/front/AuthMenu.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/front/AuthMenu.vue ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _AuthMenu_vue_vue_type_template_id_5148c8f8_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AuthMenu.vue?vue&type=template&id=5148c8f8&scoped=true */ "./resources/js/components/front/AuthMenu.vue?vue&type=template&id=5148c8f8&scoped=true");
/* harmony import */ var _AuthMenu_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AuthMenu.vue?vue&type=script&lang=js */ "./resources/js/components/front/AuthMenu.vue?vue&type=script&lang=js");
/* harmony import */ var _AuthMenu_vue_vue_type_style_index_0_id_5148c8f8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css */ "./resources/js/components/front/AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css");
/* harmony import */ var D_laragon_www_laravel_lms_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,D_laragon_www_laravel_lms_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_AuthMenu_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_AuthMenu_vue_vue_type_template_id_5148c8f8_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-5148c8f8"],['__file',"resources/js/components/front/AuthMenu.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/front/AuthMenu.vue?vue&type=script&lang=js":
/*!****************************************************************************!*\
  !*** ./resources/js/components/front/AuthMenu.vue?vue&type=script&lang=js ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AuthMenu_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AuthMenu_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AuthMenu.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/front/AuthMenu.vue?vue&type=template&id=5148c8f8&scoped=true":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/front/AuthMenu.vue?vue&type=template&id=5148c8f8&scoped=true ***!
  \**********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AuthMenu_vue_vue_type_template_id_5148c8f8_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AuthMenu_vue_vue_type_template_id_5148c8f8_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AuthMenu.vue?vue&type=template&id=5148c8f8&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=template&id=5148c8f8&scoped=true");


/***/ }),

/***/ "./resources/js/components/front/AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css":
/*!************************************************************************************************************!*\
  !*** ./resources/js/components/front/AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css ***!
  \************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_10_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_10_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AuthMenu_vue_vue_type_style_index_0_id_5148c8f8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/front/AuthMenu.vue?vue&type=style&index=0&id=5148c8f8&scoped=true&lang=css");


/***/ })

}]);