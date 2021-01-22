<template>
    <div class="flex justify-center items-center">
        <div class="flex items-end flex-1 flex-col">
            <span class="mr-2 text-gray-800 text-sm mb-1">{{ behindBy }} behind</span>
            <div style="height: 5px" class="bg-gray-300 w-1/2 rounded-tl-full rounded-bl-full"></div>
        </div>
        <div class="h-10 bg-gray-500" style="width:2px"></div>
        <div class="flex flex-1 flex-col">
            <span class="ml-2 text-gray-800 text-sm mb-1">{{ aheadBy }} ahead</span>
            <div style="height: 5px" class="bg-gray-300 w-1/2 rounded-tr-full rounded-br-full"></div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        behindBy: {
            type: Number,
            default: 0
        },
        aheadBy: {
            type: Number,
            default: 0
        },
        max: {
            type: Number,
            default: 0
        }
    },
    computed: {
        maxScale() {
            return Math.max(this.behindBy, this.aheadBy, +this.max);
        }
    }
}
</script>