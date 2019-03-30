const BASIC_FIELD = {
    name: "", // group__field
    type: "", // control type
    defaultValue: "",

    // some other configs...
    dateFormat: "", // for datepicker
    dateTimeFormat: "", // for datetimepicker
    timeFormat: "", // for time format

    // for select2
    isMultiple: false,
    ajaxSource: "",
    isAjax: true,
    dataSource: [],
};

const CONTROL_TYPE_MAPPING = {
    1: "numeric",
    2: "string",
    3: "tags",
    4: "date",
    5: "datetime",
    6: "time"
};

const CUSTOM_FIELD = {
    custom_control: {
        label: "Custom Control",
    },
};