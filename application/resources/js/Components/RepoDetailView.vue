<template>
    <base-container>
        <div class="flex mb-4">
            <div style="width: 50px; height:50px" class="mr-4">
                <img :src="repository.owner.avatar_url" />
            </div>
            <div class="flex flex-col">
                <span class="text-lg font-semibold">{{ repository.name }}</span>
                <div class="flex items-center">
                    <span>{{ repository.owner.name }}</span>
                    <div class="flex items-center ml-4">
                        <Icon icon="code-branch" />
                        <span class="ml-2">{{
                            repository.default_branch
                        }}</span>
                    </div>
                </div>
                <p class="italic">{{ repository.description }}</p>
            </div>
        </div>
    </base-container>
</template>
<script>
import BaseContainer from "@/Components/Base/Container";
import BaseCard from "@/Components/Base/Card";
import Icon from "@/Components/Base/Icon";

export default {
    components: {
        BaseContainer,
        BaseCard,
        Icon
    },
    props: {
        repository: Object
    }
};
</script>

<style lang="scss" scoped></style>
