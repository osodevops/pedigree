<template>
    <base-container>
        <div class="flex mb-4">
            <div style="width: 75px; height:75px" class="mr-4">
                <img :src="repository.owner.avatar_url" />
            </div>
            <div class="flex flex-col">
                <span class="text-2xl font-semibold">{{
                    repository.name
                }}</span>
                <div class="flex items-center">
                    <span class="font-bold">{{ repository.owner.name }}</span>
                    <div class="flex items-center ml-4">
                        <Icon icon="code-branch" class="text-gray-400" />
                        <span class="ml-2 font-bold">{{
                            repository.default_branch
                        }}</span>
                    </div>
                    <div class="flex items-center ml-4">
                        <Icon icon="code-branch" class="text-gray-400" />
                        <span class="ml-2"
                            ><span class="font-bold">{{
                                repository.forks.total
                            }}</span>
                            forks</span
                        >
                    </div>
                    <div class="flex items-center ml-4">
                        <Icon icon="star" class="text-gray-400" />
                        <span class="ml-2"
                            ><span class="font-bold">{{
                                repository.activity.watchers_count
                            }}</span>
                            stars</span
                        >
                    </div>
                </div>
                <div class="mt-2">
                    <p class="italic">{{ repository.description }}</p>
                    <a
                        class="italic text-blue-500 hover:text-blue-400"
                        :href="repository.url"
                        >{{ repository.url }}</a
                    >
                </div>
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
