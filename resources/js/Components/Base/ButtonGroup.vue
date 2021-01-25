<template>
    <div :class="`flex items-center btn-group ${classes}`">
            <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        classes: String
    }
}
</script>

<style scoped>
.btn-group {
    border-radius: 6px;
    border: 1px solid #E5E7EB;
    overflow: hidden;
}
.btn-group button {
    outline: none;
    height: 100%;
    font-size: 14px;
    padding: 5px 16px;
    font-weight: 500;
    line-height: 20px;
    flex-grow: 1;
}
.btn-group button:hover {
    background-color: #F3F4F6;
}
.btn-group button.active {
    background-color: #0366d6;
    color: #fff;
}
.btn-group button.active:hover {
    background-color: #0366d6;
}
.btn-group button:not(:last-child) {
    border-right: 1px solid #E5E7EB;
}
</style>