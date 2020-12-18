<template>
    <div>
        <div class="flex">
            <div style="width: 50px; height:50px" class="mr-4">
                <img :src="repository.owner.avatar_url">
            </div>
            <div class="flex flex-col">
                <span class="text-lg font-semibold">{{repository.name}}</span>
                <span>{{repository.owner.name}}</span>
                <p class="italic">{{repository.description}}</p>
            </div>
        </div>

    </div>
</template>
<script>
import BaseCard from "@/Components/Base/Card";

export default {
    components: {
        BaseCard
    },
    props: {
        repository: Object
    }
};
</script>

<style lang="scss" scoped></style>
