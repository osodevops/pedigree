<template>
    <div>
        <div class="mx-auto flex flex-wrap flex-1">
            <base-card>
                <div class="max-w-full">
                    <commits-heatmap :username="repository.owner.name" :repository="repository.name" />
                </div>
            </base-card>
            <div class="min-w-xs max-w-sm p-4">
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
                    <Icon icon="star" class="text-gray-400" />
                    <span class="ml-2"
                        ><span class="font-bold">{{
                            repository.watchers_count
                        }}</span>
                        stars</span
                    >
                </div>

                <!-- languages section -->
            </div>
        </div>

        <div v-show="forkData.length > 0" class="mx-auto mt-3 mb-2">
            <section class="w-full flex flex-wrap">
                <h1 class="text-2xl text-gray-700">
                    Forks
                </h1>

                <jet-input
                    class="ml-auto w-1/5"
                    placeholder="search by fork user, or status"
                    @input="updateSearch"
                ></jet-input>
            </section>

            <section class="w-full mt-3">
                <div
                    v-for="(fork, index) in filtedForkedData"
                    :key="fork.id"
                    class="w-full"
                >
                    <div
                        class="flex flex-wrap mb-3 p-4 bg-white rounded shadow-sm"
                    >
                        <div
                            v-if="fork.showMore === false"
                            class="w-full flex flex-wrap justify-between items-center"
                        >
                            <div class="w-1/5 flex">
                                <div
                                    class="w-48 mr-4"
                                    style="width: 48px; height:48px;"
                                >
                                    <img :src="fork.owner.avatar_url" />
                                </div>

                                <div class="w-auto">
                                    <span
                                        class="capitalize text-xl font-semibold"
                                    >
                                        {{ fork.owner.name }}
                                    </span>

                                    <span class="block text-sm text-gray-600">
                                        {{ fork.description }}
                                    </span>

                                    <div class="flex items-center">
                                        <Icon
                                            icon="code-branch"
                                            class="text-gray-400"
                                        />
                                        <span
                                            class="ml-2 text-sm text-gray-600"
                                            >{{ fork.default_branch }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center">
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

                            <div class="flex items-center">
                                <Icon icon="star" class="text-gray-400" />
                                <span class="ml-2"
                                    ><span class="text-sm font-semibold">{{
                                        fork.activity.watchers_count
                                    }}</span>
                                    stars</span
                                >
                            </div>

                            <div>
                                <span>
                                    Status
                                    <!-- Status: {{ fork.difference.status || "-" }} -->
                                </span>
                            </div>

                            <div>
                                <jet-button
                                    type="button"
                                    @click.native="updateForkShowState(index)"
                                    >More Info</jet-button
                                >
                            </div>
                        </div>
                        <div v-else class="w-full flex flex-wrap">
                            <div
                                class="w-full flex flex-wrap justify-between items-center"
                            >
                                <div class="w-1/5 flex">
                                    <div
                                        class="w-48 mr-4"
                                        style="width: 48px; height:48px;"
                                    >
                                        <img :src="fork.owner.avatar_url" />
                                    </div>

                                    <div class="w-auto">
                                        <span
                                            class="capitalize text-xl font-semibold"
                                        >
                                            {{ fork.owner.name }}
                                        </span>

                                        <span
                                            class="block text-sm text-gray-600"
                                        >
                                            {{ fork.description }}
                                        </span>

                                        <div class="flex items-center">
                                            <Icon
                                                icon="code-branch"
                                                class="text-gray-400"
                                            />
                                            <span
                                                class="ml-2 text-sm text-gray-600"
                                                >{{ fork.default_branch }}</span
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center">
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

                                <div class="flex items-center">
                                    <Icon icon="star" class="text-gray-400" />
                                    <span class="ml-2"
                                        ><span class="text-sm font-semibold">{{
                                            fork.activity.watchers_count
                                        }}</span>
                                        stars</span
                                    >
                                </div>

                                <div>
                                    <a
                                        :href="fork.url"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                        >View on Github</a
                                    >

                                    <jet-button
                                        type="button"
                                        @click.native="
                                            updateForkShowState(index)
                                        "
                                        class="ml-3"
                                        >Less Info</jet-button
                                    >
                                </div>
                            </div>
                            <historgram-graph></historgram-graph>
                        </div>

                        <!-- <div class="w-full">
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
                                                {{
                                                    fork.difference.ahead_by ||
                                                        "-"
                                                }}
                                            </td>
                                            <td class="text-sm px-2 py-1">
                                                {{
                                                    fork.difference.behind_by ||
                                                        "-"
                                                }}
                                            </td>
                                            <td class="text-sm px-2 py-1"></td>
                                            <td class="text-sm px-2 py-1">
                                                {{
                                                    fork.difference
                                                        .total_commits || "-"
                                                }}
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
                            </div> -->
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
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import CommitsHeatmap from '@/Components/HeatmapContainer.vue';

export default {
    components: {
        BaseContainer,
        BaseCard,
        Icon,
        JetInput,
        JetButton,
        CommitsHeatmap,
    },
    props: {
        repository: Object,
        forkData: {
            type: Array
        },
        loading: Boolean
    },
    data() {
        return {
            searchText: "",
            forks: []
        };
    },
    computed: {
        filtedForkedData() {
            return this.forks.filter(fork => {
                if (this.searchText === "") return fork;

                if (this.searchText.toLowerCase() === fork.status.toLowerCase()) {
                    return fork;
                } else {
                    if (
                        fork.owner.name
                            .toLowerCase()
                            .includes(this.searchText.toLowerCase())
                    )
                        return fork;
                }
            });
        }
    },
    mounted() {
        let forks = _.cloneDeep(
            this.forkData.map(fork => {
                fork.showMore = false;
                return fork;
            })
        );

        forks.forEach((fork, index) => {
            this.$set(this.forks, index, fork);
        });
    },
    methods: {
        updateSearch(value) {
            this.searchText = value;
        },
        updateForkShowState(index) {
            this.forks[index].showMore === true
                ? (this.forks[index].showMore = false)
                : (this.forks[index].showMore = true);
        }
    }
};
</script>

<style lang="scss" scoped></style>
