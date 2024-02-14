import FormInput from "./components/form/Input.vue";
import FormSelect from "./components/form/Select.vue";
import FormTextarea from "./components/form/Textarea.vue";
import FormCheckbox from "./components/form/Checkbox.vue";
import FormError from "./components/form/Error.vue";

import ProductCategoryLoader from './components/product/CategoryLoader.vue'

export const components = [
    { name: "form-input", component: FormInput },
    { name: "form-select", component: FormSelect },
    { name: "form-textarea", component: FormTextarea },
    { name: "form-checkbox", component: FormCheckbox },
    { name: "form-error", component: FormError },
    { name: "product-category-loader", component: ProductCategoryLoader },
];
