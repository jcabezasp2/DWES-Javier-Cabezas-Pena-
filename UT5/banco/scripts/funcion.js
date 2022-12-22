"use strict";
exports.__esModule = true;
exports.invoke = void 0;
var invoke = function (name, workId, id, params) {
    if (params === void 0) { params = undefined; }
    var url = "/api/modules/".concat(name, "/").concat(workId, "/invoke/").concat(id);
    return fetch(url, {
        method: 'POST',
        body: JSON.stringify(params !== null && params !== void 0 ? params : {}),
        headers: {
            'Content-Type': 'plain/text'
        }
    });
};
exports.invoke = invoke;
