<script lang="ts" setup>
import { router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { route } from "ziggy-js";
import _ from "lodash";
import DangerButton from "../Breeze/DangerButton.vue";
import { Species } from "@/interfaces/Species";
import { ArrowDownIcon, ArrowUpIcon } from "@heroicons/vue/24/outline";

defineProps<{
    species: Species[];
}>();

const query = new URLSearchParams(window.location.search);

const filter = ref({
    name: query.get("filter[name]") || "",
    species: query.get("filter[species]") || "",
    breed: query.get("filter[breed]") || "",
    available: query.get("filter[available]") === "true" || false,
});

const sortTerm = ref(query.get("sort") || "name");

const applySort = () => {
    router.get(
        route("animals.index"),
        { sort: sortTerm.value.includes("-") ? "updated_at" : "-updated_at" },
        { preserveState: true, preserveScroll: true }
    );
    sortTerm.value = sortTerm.value.includes("-")
        ? "updated_at"
        : "-updated_at";
};

const applyFilter = () => {
    router.get(
        route("animals.index"),
        {
            "filter[name]": filter.value.name,
            "filter[species]": filter.value.species,
            "filter[breed]": filter.value.breed,
            "filter[available]": filter.value.available,
        },
        { preserveState: true, preserveScroll: true }
    );
};

const resetFilter = () => {
    filter.value.name = "";
    filter.value.species = "";
    filter.value.breed = "";
    filter.value.available = false;
};

watch(
    () => filter.value.name,
    _.debounce((newValue) => {
        router.get(
            route("animals.index"),
            { "filter[name]": newValue },
            { preserveState: true, preserveScroll: true }
        );
    }, 300)
);
watch(
    () => filter.value.species,
    (newValue) => {
        router.get(
            route("animals.index"),
            { "filter[species]": newValue },
            { preserveState: true, preserveScroll: true }
        );
    }
);

watch(
    () => filter.value.breed,
    _.debounce((newValue) => {
        router.get(
            route("animals.index"),
            { "filter[breed]": newValue },
            { preserveState: true, preserveScroll: true }
        );
    }, 300)
);

watch(
    () => filter.value.available,
    (newValue) => {
        router.get(
            route("animals.index"),
            { "filter[available]": newValue },
            { preserveState: true, preserveScroll: true }
        );
    }
);
</script>
<template>
    <form @submit.prevent="applyFilter">
        <div
            class="flex justify-start items-center bg-white rounded-lg shadow p-4 mb-4"
        >
            <input
                type="text"
                placeholder="Search by name"
                class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mr-4"
                v-model="filter.name"
            />

            <label for="filter-species" class="mr-2 text-sm text-gray-800"
                >Species:</label
            >
            <select
                id="filter-species"
                class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mr-4"
                v-model="filter.species"
            >
                <option value="">All</option>
                <option v-for="s in species" :key="s.id" :value="s.id">
                    {{ s.name }}
                </option>
            </select>

            <input
                type="text"
                placeholder="Search by breed"
                class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mr-4"
                v-model="filter.breed"
            />

            <label class="flex items-center space-x-2">
                <input
                    type="checkbox"
                    class="form-checkbox text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    v-model="filter.available"
                />
                <span class="text-sm text-gray-800">Available only</span>
            </label>

            <a
                @click.prevent="applySort"
                :href="
                    route('animals.index', {
                        sort: sortTerm?.value?.includes('-')
                            ? '-updated_at'
                            : 'updated_at',
                    })
                "
                class="ml-4 text-sm text-gray-800"
            >
                <span v-if="sortTerm?.value?.includes('-')">
                    <ArrowUpIcon class="h-4 w-4 inline-block" /> Sort by oldest
                </span>
                <span v-else>
                    <ArrowDownIcon class="h-4 w-4 inline-block" /> Sort by
                    recent
                </span>
            </a>

            <DangerButton type="button" class="ml-auto" @click="resetFilter">
                Reset
            </DangerButton>
        </div>
    </form>
</template>
