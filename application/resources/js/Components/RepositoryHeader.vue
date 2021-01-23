<template>
    <div>
        <div class="flex flex-col sm:flex-row mb-4">
            <div style="width: 75px; height:75px" class="mr-4">
                <img :src="repository.owner.avatar_url" />
            </div>
            <div class="flex flex-col">
                <h1 class="flex flex-col sm:flex-row mb-2">
                    <span class="text-md sm:text-xl">{{ repository.name }}</span>
                    <span class="text-xl mx-2 hidden sm:block">/</span>
                    <span class="text-xl font-semibold">{{ repository.owner.name }}</span>
                </h1>
                <div class="mb-2">
                    <p class="text-sm text-gray-700">{{ repository.description }}</p>
                </div>
                <div class="flex text-black flex-col sm:flex-row">
                    <div class="flex items-center mr-4 mb-1 sm:mb-0">
                        <Icon icon="code-branch" size="sm" />
                        <span class="text-sm ml-1">{{repository.default_branch}}</span>
                    </div>
                    <div class="flex items-center mr-4 mb-1 sm:mb-0">
                        <Icon icon="star" size="sm" />
                        <span class="text-sm ml-1"><span class="font-bold">{{numberFormat(repository.watchers_count)}}</span> stars</span>
                    </div>
                    <div class="flex items-center mb-1 sm:mb-0" v-if="repository.license">
                        <Icon icon="balance-scale" size="sm" />
                        <span class="text-sm ml-1">{{ repository.license }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import JetNavLink from "@/Jetstream/NavLink";
import Icon from "@/Components/Base/Icon";

export default {
    components: {
        JetNavLink,
        Icon,
    },
    props: {
        repository: Object
    },
    data() {
        return {
            tab: "overview",
        }
    },
    methods: {
        numberFormat(number) {
            return window.numberFormat(number);
        },
    },
}
</script>