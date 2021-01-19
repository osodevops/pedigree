<template>
    <div>
        <h1 class="w-3/4 mx-auto text-2xl mt-2 mb-2 text-gray-700">
            Repository Overview
        </h1>

        <div class="mx-auto flex flex-wrap w-3/4">
            <base-container>
                <div class="flex mb-4">
                    <!-- Repository Information -->
                    <div style="width: 75px; height:75px" class="mr-4">
                        <img :src="repository.owner.avatar_url" />
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl"
                            >{{ repository.name }} /
                            <span class="font-semibold">{{
                                repository.owner.name
                            }}</span></span
                        >
                        <div class="mt-2">
                            <p class="italic">{{ repository.description }}</p>
                        </div>

                        <HistorgramGraph />
                    </div>
                </div>
            </base-container>
            <div class="w-1/4 p-4">
                <a
                    class="underline text-decoration-none text-gray-600 hover:text-gray-400 leading-3 cursor-pointer"
                    :href="repository.url"
                    >View on Github
                    <Icon icon="location-arrow" class="text-gray-400"
                /></a>
                <div class="flex items-center">
                    <Icon icon="code-branch" class="text-gray-400" />
                    <span class="font-bold ml-2">{{
                        repository.default_branch
                    }}</span>
                </div>
                <div class="flex items-center">
                    <Icon icon="code-branch" class="text-gray-400" />
                    <span class="ml-2">
                        <span class="font-bold">{{
                            repository.forks.total
                        }}</span>
                        forks
                    </span>
                </div>
                <div class="flex items-center">
                    <Icon icon="star" class="text-gray-400" />
                    <span class="ml-2"
                        ><span class="font-bold">{{
                            repository.activity.watchers_count
                        }}</span>
                        stars</span
                    >
                </div>

                <!-- languages section -->
            </div>
        </div>

        <div v-show="forkData.length > 0" class="w-3/4 mx-auto mt-3 mb-2">
            <section class="w-full flex flex-wrap">
                <h1 class="text-2xl text-gray-700">
                    Fork Information
                </h1>

                <jet-input
                    class="ml-auto w-128"
                    placeholder="search by fork user, or status"
                    @input="updateSearch"
                ></jet-input>
            </section>
            <section class="w-full mt-3">
                <div
                    v-for="fork in filtedForkedData"
                    :key="fork.id"
                    class="w-full"
                >
                    <div class="flex p-4 bg-white rounded shadow-md">
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
                                                <!-- {{ fork.difference.ahead_by || '-' }} -->
                                            </td>
                                            <td class="text-sm px-2 py-1">
                                                <!-- {{ fork.difference.behind_by || '-' }} -->
                                            </td>
                                            <td class="text-sm px-2 py-1">
                                                <!-- {{ fork.difference.status || '-' }} -->
                                            </td>
                                            <td class="text-sm px-2 py-1">
                                                <!-- {{ fork.difference.total_commits || '-' }} -->
                                            </td>
                                            <td class="text-sm px-2 py-1">
                                                {{ fork.issues.open || "-" }}
                                            </td>
                                            <td
                                                class="text-sm px-2 py-1"
                                                v-show="fork.issues.resolved"
                                            >
                                                {{
                                                    fork.issues.resolved || "-"
                                                }}
                                            </td>
                                            <td
                                                class="text-sm px-2 py-1"
                                                v-show="fork.issues.total"
                                            >
                                                {{ fork.issues.total }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <HistorgramGraph />
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>
<script>
import BaseContainer from "@/Components/Base/Container";
import BaseCard from "@/Components/Base/Card";
import Icon from "@/Components/Base/Icon";
import HistorgramGraph from "@/Components/HistorgramGraph";
import JetInput from "@/Jetstream/Input";

export default {
    components: {
        BaseContainer,
        BaseCard,
        Icon,
        HistorgramGraph,
        JetInput
    },
    props: {
        repository: Object,
        forkData: Array
    },
    data() {
        return {
            searchText: ""
        };
    },
    computed: {
        filtedForkedData() {
            return this.forkData;
        }
    },
    methods: {
        updateSearch(value) {
            this.searchText = value;
        }
    }
};
</script>

<style lang="scss" scoped></style>
