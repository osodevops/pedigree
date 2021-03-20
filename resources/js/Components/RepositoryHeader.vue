<template>
    <div>
        <div class="flex flex-col sm:flex-row mb-4">
            <div style="width: 75px; height:75px" class="mr-4">
                <a class="block w-full" :href="`https://gihub.com/${repository.owner.id}/${repository.name}`" target="_blank">
                    <img :src="repository.owner.avatar_url" />
                </a>
            </div>
            <div class="flex flex-col">
                <h1 class="mb-2">
                    <a class="flex flex-col sm:flex-row" :href="`https://gihub.com/${repository.owner.id}/${repository.name}`" target="_blank">
                        <span class="text-md sm:text-xl">{{ repository.owner.id }}</span>
                        <span class="text-xl px-2 hidden sm:block">/</span>
                        <span class="text-xl font-semibold">{{ repository.name }}</span>
                    </a>
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