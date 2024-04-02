<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, router } from "@inertiajs/vue3";
import TagCategoryRow from "@/Components/Admin/TagCategoryRow.vue";
import { ref, defineProps } from "vue";
// import CustomModal from "@/Components/CustomModal.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    categories: {
        type: Array,
        default: () => [],
    },
    errors: {
        type: Object,
        default: () => {},
    },
});

const showCreateModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const form = useForm({ name: "" });

const handleDelete = (data) => {
    router.delete(route("admin:category:destroy", data.slug), {
        onSuccess: () => {
            showDeleteModal.value = false;
            form.reset();
        }
    });
};

const handleEdit = (input, data) => {
    router.put(
        route("admin:category:update", input.slug),
        { name: data },
        {
            onSuccess: () => {
                showEditModal.value = false;
                form.reset();
            }
        }
    );
};

const handleCreate = () => {
    props.errors.category = null;
    router.post(route("admin:category:store"), form.data(), {
        onSuccess: () => {
            showCreateModal.value = false;
            form.reset();
        },
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
                    <tr
                        class="text-sm font-medium text-gray-700 border-b border-gray-200"
                    >
                        <td class="pl-10 w-1/4 bg-gray-100 rounded-tl-lg text-center">
                            Name
                        </td>
                        <td class="pl-10 w-1/4 bg-gray-100 text-center">
                            Slug
                        </td>
                        <td
                            class="py-4 px-4 text-center bg-gray-100 rounded-tr-lg"
                        >
                            Action
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <TagCategoryRow
                        :name="'category'"
                        v-for="data in categories"
                        :key="data.id"
                        :data="data"
                        :handleDelete="handleDelete"
                        :handleEdit="handleEdit"
                        :showEditModal="showEditModal"
                        :showDeleteModal="showDeleteModal"
                    />
                </tbody>
            </table>
        </div>
    </template>
    </AdminLayout>

    <Modal title="Create new category" :open="showCreateModal">
        <template #body>
            <div>
                <input
                    type="text"
                    name="name"
                    id="tag"
                    class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.name"
                    placeholder="Type your category name"
                />
            </div>
            <div class="text-xs text-red-500">
                <p
                    v-if="errors.name"
                    class="text-center mb-4"
                    v-text="errors.name"
                ></p>
            </div>
            <div class="flex justify-center">
                <button @click="handleCreate" class="btn-primary mr-2">
                    Create
                </button>
                <button
                    @click="showCreateModal = false"
                    class="btn-primary bg-red-500"
                >
                    Close
                </button>
            </div>
        </template>
    </Modal>
   
</template>
