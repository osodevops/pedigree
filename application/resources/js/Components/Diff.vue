<template>
    <div class="flex justify-center items-center w-44">
        <div class="flex items-end flex-1 flex-col">
            <span class="mr-2 text-gray-800" style="font-size: 10px">{{ behindBy }}</span>
            <div class="w-full flex justify-end">
                <div style="height: 4px;" :style="{width: behindPercentage}" class="bg-gray-300 rounded-tl-full rounded-bl-full"></div>
            </div>
        </div>
        <div class="h-5 bg-gray-500" style="width:1px"></div>
        <div class="flex flex-1 flex-col">
            <span class="ml-2 text-gray-800" style="font-size: 10px">{{ aheadBy }}</span>
            <div class="w-full">
                <div style="height: 4px" :style="{width: aheadPercentage}" class="bg-gray-300 rounded-tr-full rounded-br-full"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        behindBy: {
            type: Number,
            default: 0,
            required: true,
        },
        aheadBy: {
            type: Number,
            default: 0,
            required: true,
        },
        max: {
            type: Number,
            default: 0
        }
    },
    computed: {
        maxScale() {
            return Math.max(this.behindBy, this.aheadBy, +this.max, 1);
        },
        aheadPercentage() {
            const perc = Math.min(
                100, Math.floor((this.aheadBy / this.maxScale) * 100) + 2
            );
            return `${perc}%`;
        },
        behindPercentage() {
            const perc = Math.min(
                100, Math.floor((this.behindBy / this.maxScale) * 100) + 2
            );
            return `${perc}%`;
        }
    }
}
</script>