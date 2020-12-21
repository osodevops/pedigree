<template>
    <base-container>
        <div class="flex mb-4">
            <!-- Repository Information -->
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

                <!-- fork data section -->
                <div class="flex flex-wrap">
                    <div
                        v-for="fork in forkData"
                        :key="fork.id"
                        class="flex w-1/2 p-4"
                    >
                        <div style="width: 75px; height:75px" class="mr-4">
                            <img :src="fork.owner.avatar_url" />
                        </div>

                        <div class="flex w-2/3 flex-wrap">
                            <span class="font-semibold text-2xl w-full">
                                {{ fork.owner.name }}
                            </span>

                            <div class="flex w-full">
                                <div class="flex">
                                    <Icon
                                        icon="code-branch"
                                        class="text-gray-400"
                                    />
                                    <span class="ml-2 font-bold">{{
                                        fork.default_branch
                                    }}</span>
                                </div>
                                <div class="flex ml-4">
                                    <Icon
                                        icon="code-branch"
                                        class="text-gray-400"
                                    />
                                    <span class="ml-2"
                                        ><span class="font-bold">{{
                                            fork.forks.total
                                        }}</span>
                                        forks</span
                                    >
                                </div>
                                <div class="flex ml-4">
                                    <Icon icon="star" class="text-gray-400" />
                                    <span class="ml-2"
                                        ><span class="font-bold">{{
                                            fork.activity.watchers_count
                                        }}</span>
                                        stars</span
                                    >
                                </div>
                            </div>

                            <div class="w-full mt-2">
                                <p class="italic">{{ fork.description }}</p>
                                <a
                                    class="italic text-blue-500 hover:text-blue-400"
                                    :href="fork.url"
                                    >{{ fork.url }}</a
                                >
                            </div>
                        </div>

                        <div class="w-1/3">
                            <p>
                                Is ahead by:
                                <span class="font-semibold">{{
                                    fork.difference.ahead_by
                                }}</span>
                            </p>
                            <p>
                                Is behind by:
                                <span class="font-semibold">{{
                                    fork.difference.behind_by
                                }}</span>
                            </p>
                            <p>
                                Current Status:
                                <span class="font-semibold">{{
                                    fork.difference.status
                                }}</span>
                            </p>
                            <p>
                                Total Commits:
                                <span class="font-semibold">{{
                                    fork.difference.total_commits
                                }}</span>
                            </p>
                            <p>
                                Open Issues:
                                <span class="font-semibold">{{
                                    fork.issues.open
                                }}</span>
                            </p>
                            <p v-show="fork.issues.resolved">
                                Issues Resolved:
                                <span class="font-semibold">{{
                                    fork.issues.resolved
                                }}</span>
                            </p>
                            <p v-show="fork.issues.total">
                                Total Amount of Issues:
                                <span class="font-semibold">{{
                                    fork.issues.resolved
                                }}</span>
                            </p>
                        </div>
                    </div>
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
        repository: Object,
        forkData: Array
    }
};
</script>

<style lang="scss" scoped></style>
