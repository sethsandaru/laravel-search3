import {TemplateStorage} from "./storage";
import {pre_html} from "./ui/template/pre_html";
import {Renderer} from "./ui";

let Search3Template = {};

Search3Template.init = function (containerId, sidebarData) {
    TemplateStorage.containerID = containerId;
    TemplateStorage.search_form_obj = {};
    TemplateStorage.table_result_obj = {};

    // pre-render some container inside
    $(containerId).html(pre_html);
};

Search3Template.setData = function (data) {
    // parse data
    TemplateStorage.search_form_obj = JSON.parse(data.search_form);
    TemplateStorage.table_result_obj = JSON.parse(data.table_result);

    // clear
    Renderer.clear();

    // render again
    Renderer.render(TemplateStorage.search_form_obj, TemplateStorage.table_result_obj);
};

Search3Template.getData = function () {

};

export {
    Search3Template
}