<template>
    <section class="w-full mt-3">
        <div
            v-for="(fork, index) in filteredForks"
            :key="fork.id"
            class="w-full"
        >
            <div class="flex flex-wrap mb-3 p-4 bg-white rounded shadow-sm">
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
                            <span class="capitalize text-xl font-semibold">
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
                                <span class="ml-2 text-sm text-gray-600">{{
                                    fork.default_branch
                                }}</span>
                            </div>
                        </div>
                    </div>

                    <div v-if="fork.forks" class="flex items-center">
                        <Icon icon="code-branch" class="text-gray-400" />
                        <span class="ml-2"
                            ><span class="text-sm font-semibold">{{
                                fork.forks.total || "-"
                            }}</span>
                            forks</span
                        >
                    </div>

                    <div class="flex items-center">
                        <Icon icon="star" class="text-gray-400" />
                        <span class="ml-2"
                            ><span class="text-sm font-semibold">{{
                                fork.watchers_count
                            }}</span>
                            stars</span
                        >
                    </div>

                    <div v-if="fork.difference">
                        <Diff
                            :aheadBy="
                                fork.difference ? fork.difference.ahead_by : 0
                            "
                            :behindBy="
                                fork.difference ? fork.difference.behind_by : 0
                            "
                            :max="forkMaxScale"
                        />
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
                                <span class="capitalize text-xl font-semibold">
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
                                    <span class="ml-2 text-sm text-gray-600">{{
                                        fork.default_branch
                                    }}</span>
                                </div>
                            </div>
                        </div>

                        <div v-if="fork.forks" class="flex items-center">
                            <Icon icon="code-branch" class="text-gray-400" />
                            <span class="ml-2"
                                ><span class="text-sm font-semibold">{{
                                    fork.forks.total || "-"
                                }}</span>
                                forks</span
                            >
                        </div>

                        <div class="flex items-center">
                            <Icon icon="star" class="text-gray-400" />
                            <span class="ml-2"
                                ><span class="text-sm font-semibold">{{
                                    fork.watchers_count
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
                                @click.native="updateForkShowState(index)"
                                class="ml-3"
                                >Less Info</jet-button
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapState, mapMutations } from "vuex";
import Icon from "@/Components/Base/Icon";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import Diff from "@/Components/Diff";

export default {
    components: {
        Icon,
        JetInput,
        JetButton,
        Diff
    },
    data() {
        return {
            searchText: ""
        };
    },
    computed: {
        ...mapState("searchRepos", ["forkData"]),
        filteredForks() {
            return this.forkData.filter(fork => {
                if (this.searchText === "") return fork;

                if (
                    this.searchText.toLowerCase() === fork.status.toLowerCase()
                ) {
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
        },
        forkMaxScale() {
            if (this.filteredForks.length === 0) return 0;
            let max = 0;
            _.forEach(this.filteredForks, fork => {
                if (typeof fork.difference === "undefined") return;
                max =
                    fork.difference.ahead_by > max
                        ? fork.difference.ahead_by
                        : max;
                max =
                    fork.difference.behind_by > max
                        ? fork.difference.behind_by
                        : max;
            });
            return max;
        }
    },
    methods: {
        ...mapMutations("searchRepos", ["updateForkShowState"])
    }
};
</script>

<style lang="scss" scoped></style>
