const routes = {
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

const route = (routeName, params = [], absolute = true) => {
  const _route = routes[routeName];
  if (_route == null) throw "Requested route doesn't exist";

  let uri = _route.uri;

  const matches = uri.match(/{[\w]+\??}/g) || [];
  const optionals = uri.match(/{[\w]+\?}/g) || [];

  const requiredParametersCount = matches.length - optionals.length;

  if (params instanceof Array) {
    if (params.length < requiredParametersCount) throw "Missing parameters";

    for (let i = 0; i < requiredParametersCount; i++)
      uri = uri.replace(/{[\w]+\??}/, params.shift());

    for (let i = 0; i < params.length; i++)
      uri += (i ? "&" : "?") + params[i] + "=" + params[i];
  } else if (params instanceof Object) {
    let extraParams = matches.reduce((ac, match) => {
      let key = match.substring(1, match.length - 1);
      let isOptional = key.endsWith("?");
      if (params.hasOwnProperty(key.replace("?", ""))) {
        uri = uri.replace(new RegExp(match.replace("?", "\\?"), "g"), params[key.replace("?", "")]);
        delete ac[key.replace("?", "")];
      } else if (isOptional) {
          uri = uri.replace("/" + new RegExp(match, "g"), "");
      }
      return ac;
    }, params);

    Object.keys(extraParams).forEach((key, i) => {
      uri += (i ? "&" : "?") + key + "=" + extraParams[key];
    });
  }

  if (optionals.length > 0) {
    for (let i in optionals) {
      uri = uri.replace("/" + optionals[i], "");
    }
  }

  if (uri.includes("}")) throw "Missing parameters";

  if (absolute && process.env.MIX_APP_URL)
    return process.env.MIX_APP_URL + "/" + uri;
  return "/" + uri;
};

export { route };
