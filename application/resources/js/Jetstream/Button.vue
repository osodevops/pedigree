<template>
    <button :type="type" class="btn">
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: "submit"
        }
    }
};
</script>
