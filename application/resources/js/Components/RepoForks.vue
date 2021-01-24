<template>
    <section class="w-full mt-3">
        <section class="w-full flex flex-wrap">
            <jet-input
                class="ml-auto"
                placeholder="search by fork user, or status"
                v-model="searchText"
            ></jet-input>
        </section>
        <div>
            <div class="bg-gray-100 border border-gray-200 text-gray-700 rounded-tl-lg rounded-tr-lg">
                <div class="px-4 py-2 text-sm font-semibold">Forks</div>
            </div>
            <div
                v-for="(fork, index) in filteredForks(searchText)"
                :key="fork.id"
                class="w-full row"
            >
                <div class="flex flex-wrap p-4 border-l border-r border-b border-gray-200">
                    <div
                        v-if="fork.showMore === false"
                        class="w-full flex flex-wrap justify-between items-center"
                    >
                        <div class="flex-1 flex">
                            <div
                                class="w-48 mr-4"
                                style="width: 48px; height:48px;"
                            >
                                <img :src="fork.owner.avatar_url" />
                            </div>

                            <div class="w-auto">
                                <span class="capitalize text-xl font-semibold">
                                    {{ fork.owner.id }}
                                </span>

                                <div class="flex text-black flex-col sm:flex-row text-gray-700">
                                    <div class="flex items-center mr-4 mb-1 sm:mb-0">
                                        <Icon icon="code-branch" size="xs" />
                                        <span class="text-sm ml-1">{{fork.default_branch}}</span>
                                    </div>
                                    <div class="flex items-center mr-4 mb-1 sm:mb-0">
                                        <Icon icon="star" size="sm" />
                                        <span class="text-sm ml-1">{{numberFormat(fork.watchers_count)}} stars</span>
                                    </div>
                                    <div class="flex items-center mb-1 sm:mb-0" v-if="fork.license">
                                        <Icon icon="balance-scale" size="sm" />
                                        <span class="text-sm ml-1">{{ fork.license }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <Diff
                            :aheadBy="fork.difference ? (fork.difference.ahead_by || 0) : 0"
                            :behindBy="fork.difference ? (fork.difference.behind_by || 0) : 0"
                            :max="forkMaxScale"
                        />

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
                            <div class="flex-1 flex">
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
        </div>
    </section>
</template>

<script>
import { mapState, mapMutations, mapGetters } from "vuex";
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
        ...mapGetters("searchRepos", ["filteredForks"]),
        forkMaxScale() {
            if (this.filteredForks(this.searchText).length === 0) return 0;
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
        ...mapMutations("searchRepos", ["updateForkShowState"]),
        numberFormat(number) {
            return window.numberFormat(number);
        }
    }
};
</script>

<style scoped>
.row:last-child {
    border-radius: 0px 0px .5rem .5rem;
}
</style>
