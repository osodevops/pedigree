<template>
    <span class="fas" :class="classes"></span>
</template>

<script>
export default {
    props: {
        icon: {
            type: String,
            default: ""
        },
        size: {
            type: String,
            default: "sm"
            validator: function (value) {
                return ['xs', 'sm', 'lg', '2x', '3x', '5x', '7x', '10x'].indexOf(value) !== -1
            }
        },
    },
    computed: {
        classes() {
            return [this.prefix(this.icon), this.prefix(this.size)].join(' ');
        }
    },
    methods: {
        prefix(value) {
            return `fa-${value}`;
        }
    }
};
</script>
