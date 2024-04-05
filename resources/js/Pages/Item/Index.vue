<script setup>
import CustomModal from "@/Components/CustomModal.vue";
import FilterDropdown from "@/Components/FilterDropdown.vue";
import Table from "@/Components/Table.vue";
import VideoRow from "@/Components/VideoRow.vue";
import { errorNotification, successNotification } from '@/Composable/notification';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { router, useForm } from "@inertiajs/vue3";
import { defineProps, ref } from "vue";

const props = defineProps({
    items: {
        type: Array,
        default: () => [],
    },
    categories: {
        type: Object,
        default: () => {},
    },

    errors: {
        type: Object,
        default: () => { },
    },
});


const showCreateModal = ref(false);
const form = useForm({
    name: "",
    description: "",
    quantity: "",
    image: "",
    inventory_id: null,
});


const handleFileChange = (e) => {
    form.image = e.target.files[0];
};

const handleCreate = () => {

    props.errors = null;

    router.post(route("items:store"), form.data(), {
        onSuccess: () => {
            showCreateModal.value = false;
            form.reset();
            successNotification('Successfully created the item');
        },
         onError: (errors) => {
                errorNotification("Something went wrong!");
            }
    });
};


const allCategory = [...props.categories];

const getSelectedCategory = (selectedCategoryName) => {

    const selectedCategory = allCategory.find(category => category.name === selectedCategoryName);

    // If selectedCategory is found, set its id to form.inventory_id
    if (selectedCategory) {
        form.inventory_id = selectedCategory.id;
    }
}

</script>

<template>

    <AdminLayout>
        <template #main>
            <div class="flex justify-between mx-4 items-center py-5 px-3">
                <h1 class="text-2xl w-full">Items</h1>
                <button @click="showCreateModal = true" class="btn-primary">
                    Create
                </button>
            </div>

            <div class="rounded-md my-4 p-4 flex justify-center items-center flex-col">
            <Table v-if="items?.data?.length"
            :pagination="{ enable: items?.total > 10 ? true : false, links: items?.links, preserveState: true }"
            class="w-full border-gray-200">
            <template #thead>
                <th class="pl-4">Name</th>
                <th class="p-1 sm:p-4 text-center">Inventory Name</th>
                <th class="p-1 sm:p-4 text-center">Description</th>
                <th class="p-1 sm:p-4 text-center">Quantity</th>
                <th class="p-1 sm:p-4 text-center">Action</th>
            </template>

            <template #tbody>
                <tr v-for="video in items?.data" :key="video.id"
                    class="hover:bg-gray-100 transition-colors group border-t border-gray-200">
                    <VideoRow
                     :video="video"
                     :categories="categories"
                     :handleEdit="handleEdit" 
                     />
                </tr>

            </template>
        </Table>
        <div v-else-if="items?.total === 0"
            class="mt-20 flex w-full justify-center items-center text-gray-600 text-3xl">
            No items found
        </div>
            </div>
        </template>
    </AdminLayout>

    <CustomModal title="Create new item" :open="showCreateModal">
        <template #body>
            <FilterDropdown
                    class="text-sm"
                    :drop-down-data="allCategory"
                    :default="0"
                    @getFilterData="getSelectedCategory"
                />
            <div>
                <input type="text" name="name" id="tag" class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.name" placeholder="Type your item name" />
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors.name" class="text-center mb-4" v-text="errors.name"></p>
            </div>
            <div>
                <textarea type="text" name="name" id="tag" class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.description" placeholder="Type your description" />
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors.description" class="text-center mb-4" v-text="errors.description"></p>
            </div>
            <div>
                <input type="number" name="name" id="tag" class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.quantity" placeholder="Type your quantity" />
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors.quantity" class="text-center mb-4" v-text="errors.quantity"></p>
            </div>
            <div>
                <input type="file" @change="handleFileChange" class="border my-4 border-gray-400 rounded-md w-full p-2"/>
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors.image" class="text-center mb-4" v-text="errors.image"></p>
            </div>
            <div class="flex justify-center gap-5">
                <button @click="showCreateModal = false" class="btn-primary bg-red-500">
                    Cancel
                </button>

                <button @click="handleCreate" class="btn-primary">
                    Save
                </button>

            </div>
        </template>
    </CustomModal>

</template>
