let Renderer = {};

const TEMPLATE_BODY = "#templateBody";

Renderer.render = function (search_form = {}, table_result = {}) {

};

Renderer.clear = function () {
    $(TEMPLATE_BODY).html('');
};

export {
    Renderer
}