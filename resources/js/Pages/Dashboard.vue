<script setup>
import TagCategoryRow from "@/Components/Admin/TagCategoryRow.vue";
import CustomModal from "@/Components/CustomModal.vue";
import { errorNotification, successNotification } from '@/Composable/notification';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { router, useForm } from "@inertiajs/vue3";
import { defineProps, ref } from "vue";

const props = defineProps({
    categories: {
        type: Array,
        default: () => [],
    },
    errors: {
        type: Object,
        default: () => { },
    },
});

const showCreateModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const form = useForm({
    name: "",
    description: "",

});

const handleDelete = (data) => {
    router.delete(route("inventory:destroy", data.slug), {
        onSuccess: () => {
            showDeleteModal.value = false;
            form.reset();
            successNotification("Inventory Deleted Successfully");
        },
            onError: (errors) => {
                errorNotification( "Something went wrong!");
            }
    });
};

const handleEdit = (input, data) => {
    props.errors.category = null;

    router.put(
        route("inventory:update", input.slug),
        data,
        {
            onSuccess: () => {
                showEditModal.value = false;
                form.reset();
                successNotification("Inventory Updated Successfully");
            },
            onError: (error) => {
                errorNotification("Something went wrong!");
            }
            
        }
    );
};

const handleCreate = () => {

    props.errors.category = null;
    router.post(route("inventory:store"), form.data(), {
        onSuccess: () => {
            showCreateModal.value = false;
            form.reset();
            successNotification('Successfully created the inventory');
        },
         onError: (errors) => {
                errorNotification("Something went wrong!");
            }
    });
};
</script>

<template>
    <AdminLayout>
        <template #main>
            <div class="flex justify-between mx-4 items-center py-5 px-3">
                <h1 class="text-2xl w-full">Inventory</h1>
                <button @click="showCreateModal = true" class="btn-primary">
                    Create
                </button>
            </div>

            <div class="rounded-md my-4 p-4 flex justify-center items-center">
                <table class="shadow w-full rounded-md">
                    <thead>
                        <tr class="text-sm font-medium text-gray-700 border-b border-gray-200">
                            <td class=" w-1/4 bg-gray-100 rounded-tl-lg text-center">
                                Name
                            </td>
                            <td class=" w-1/4 bg-gray-100 text-center">
                                Description
                            </td>
                            <td class="py-4 px-4 text-center bg-gray-100 rounded-tr-lg">
                                Action
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <TagCategoryRow 
                        :name="'invetory'" 
                        v-for="data in categories" 
                        :key="data.id" 
                        :data="data"
                        :handleDelete="handleDelete" 
                        :handleEdit="handleEdit" 
                        :showEditModal="showEditModal"
                        :showDeleteModal="showDeleteModal"
                        :errors="errors"
                        />
                    </tbody>
                </table>
               
            </div>
        </template>
    </AdminLayout>

    <CustomModal title="Create new inventory" :open="showCreateModal">
        <template #body>
            <div>
                <input type="text" name="name" id="tag" class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.name" placeholder="Type your inventory name" />
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
