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
                <div
                    class="flex mt-4 ml-4"
                    v-if="repository.forkData.length > 0"
                >
                    <div v-for="fork in repository.forkData" :key="fork.id">
                        <div style="width: 75px; height:75px" class="mr-4">
                            <img :src="fork.owner.avatar_url" />
                        </div>

                        <div class="flex items-center">
                            <span class="font-bold">{{ fork.owner.name }}</span>
                            <div class="flex items-center ml-4">
                                <Icon
                                    icon="code-branch"
                                    class="text-gray-400"
                                />
                                <span class="ml-2 font-bold">{{
                                    fork.default_branch
                                }}</span>
                            </div>
                            <div class="flex items-center ml-4">
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
                            <div class="flex items-center ml-4">
                                <Icon icon="star" class="text-gray-400" />
                                <span class="ml-2"
                                    ><span class="font-bold">{{
                                        fork.activity.watchers_count
                                    }}</span>
                                    stars</span
                                >
                            </div>
                        </div>

                        <div class="mt-2">
                            <p class="italic">{{ fork.description }}</p>
                            <a
                                class="italic text-blue-500 hover:text-blue-400"
                                :href="fork.url"
                                >{{ fork.url }}</a
                            >
                            <a
                                class="italic text-blue-500 hover:text-blue-400"
                                :href="fork.owner.url"
                                >Owner profiile {{ fork.owner.url }}</a
                            >
                        </div>

                        <div class="mt-2">
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
                                    fork.differences.status
                                }}</span>
                            </p>
                            <p>
                                Total Commits:
                                <span class="font-semibold">{{
                                    fork.differences.total_commits
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
                <div v-else class="flex mt-4 ml-4">
                    <p>repository has no forks</p>
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
