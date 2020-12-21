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
                        class="flex w-1/2 p-2"
                    >
                        <div style="width: 75px; height:75px" class="mr-4">
                            <img :src="fork.owner.avatar_url" />
                        </div>

                        <div class="flex flex-wrap">
                            <span class="capitalize text-2xl w-full">
                                {{ fork.owner.name }}
                            </span>

                            <div class="flex w-full">
                                <div class="flex items-center">
                                    <Icon
                                        icon="code-branch"
                                        class="text-gray-400"
                                    />
                                    <span class="ml-2 text-sm font-semibold">{{
                                        fork.default_branch
                                    }}</span>
                                </div>
                                <div class="flex items-center ml-4">
                                    <Icon
                                        icon="code-branch"
                                        class="text-gray-400"
                                    />
                                    <span class="ml-2"
                                        ><span class="text-sm font-semibold">{{
                                            fork.forks.total
                                        }}</span>
                                        forks</span
                                    >
                                </div>
                                <div class="flex items-center ml-4">
                                    <Icon icon="star" class="text-gray-400" />
                                    <span class="ml-2"
                                        ><span class="text-sm font-semibold">{{
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

                            <div class="w-full">
                                <table class="bg-white rounded mt-4">
                                    <thead>
                                        <th
                                            class="bg-gray-800 text-sm text-white font-semibold capitalize text-left px-2 py-1"
                                        >
                                            Ahead by
                                        </th>
                                        <th
                                            class="bg-gray-800 text-sm text-white font-semibold capitalize text-left px-2 py-1"
                                        >
                                            Behind by
                                        </th>
                                        <th
                                            class="bg-gray-800 text-sm text-white font-semibold capitalize text-left px-2 py-1"
                                        >
                                            Status
                                        </th>
                                        <th
                                            class="bg-gray-800 text-sm text-white font-semibold capitalize text-left px-2 py-1"
                                        >
                                            Total Commits
                                        </th>
                                        <th
                                            class="bg-gray-800 text-sm text-white font-semibold capitalize text-left px-2 py-1"
                                        >
                                            Open Issues
                                        </th>
                                        <th
                                            class="bg-gray-800 text-sm text-white font-semibold capitalize text-left px-2 py-1"
                                            v-show="fork.issues.resolved"
                                        >
                                            Issues Resolved
                                        </th>
                                        <th
                                            class="bg-gray-800 text-sm text-white font-semibold capitalize text-left px-2 py-1"
                                            v-show="fork.issues.total"
                                        >
                                            Total Issues
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-sm px-2 py-1">
                                                {{ fork.difference.ahead_by }}
                                            </td>
                                            <td class="text-sm px-2 py-1">
                                                {{ fork.difference.behind_by }}
                                            </td>
                                            <td class="text-sm px-2 py-1">
                                                {{ fork.difference.status }}
                                            </td>
                                            <td class="text-sm px-2 py-1">
                                                {{
                                                    fork.difference
                                                        .total_commits
                                                }}
                                            </td>
                                            <td class="text-sm px-2 py-1">
                                                {{ fork.issues.open }}
                                            </td>
                                            <td
                                                class="text-sm px-2 py-1"
                                                v-show="fork.issues.resolved"
                                            >
                                                {{ fork.issues.resolved }}
                                            </td>
                                            <td
                                                class="text-sm px-2 py-1"
                                                v-show="fork.issues.total"
                                            >
                                                {{ fork.issues.resolved }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
