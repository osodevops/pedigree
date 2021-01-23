<template>
    <div>
        <div class="flex">
            <div style="width: 75px; height:75px" class="mr-4">
                <img :src="repository.owner.avatar_url" />
            </div>
            <div class="flex flex-col">
                <span class="text-xl flex">
                    <span>{{ repository.name }}</span>
                    <span class="mx-2">/</span>
                    <span class="font-semibold">{{ repository.owner.name }}</span></span>
                <div class="mt-1">
                    <p class="text-sm text-gray-700">{{ repository.description }}</p>
                </div>
            </div>
        </div>
        <ul class="flex flex-no-wrap">
            <jet-nav-link href="#overview" @click="setTab('overview')" :active="tab === 'overview'">Overview</jet-nav-link>
        </ul>
    </div>
</template>

<script>
import JetNavLink from "@/Jetstream/NavLink";

export default {
    components: {
        JetNavLink,
    },
    props: {
        repository: Object
    },
    data() {
        return {
            tab: "overview",
        }
    }
}
</script>