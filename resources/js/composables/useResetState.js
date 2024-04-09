import { isRef, isReactive } from "vue";
const isObject = (value) => typeof value === "object" && value !== null;
const getPlainObject = (value) =>
    Object.keys(value).reduce((acc, key) => ({ ...acc, [key]: value[key] }), {});

export default (compositions) => {
    const refValues = [];
    const reactiveValues = [];

    const processValue = (instance) => {
        if (isReactive(instance)) {
            reactiveValues.push({ instance, initialValue: getPlainObject(instance) });
        } else if (isRef(instance)) {
            refValues.push({ instance, initialValue: instance.value });
        } else if (isObject(instance)) {
            processObject(instance);
        } else if (Array.isArray(instance)) {
            processArray(instance);
        }
    };
    const processArray = (array) => array.forEach(processValue);
    const processObject = (obj) => Object.values(obj).forEach(processValue);

    processValue(compositions);

    return () => {
        refValues.forEach(
            ({ instance, initialValue }) => (instance.value = initialValue)
        );
        reactiveValues.forEach(({ instance, initialValue }) =>
            Object.entries(initialValue).forEach(
                ([key, initialKeyValue]) => (instance[key] = initialKeyValue)
            )
        );
    };
};
