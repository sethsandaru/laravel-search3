let TemplateStorage = {};

TemplateStorage.has = function (key) {
    if (TemplateStorage[key]) {
        return true;
    }

    return false;
};

export {
    TemplateStorage
}