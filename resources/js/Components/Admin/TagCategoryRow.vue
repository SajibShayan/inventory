<script setup>
import { PencilIcon, TrashIcon } from "@heroicons/vue/24/outline";
// import CustomModal from "@/Components/CustomModal.vue";
import { ref, defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import Modal from "../Modal.vue";

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
    name: String,
    handleDelete: {
        type: Function,
        required: true,
    },
    handleEdit: {
        type: Function,
        required: true,
    },
    showDeleteModal: {
        type: Boolean,
        required: true,
    },
    showEditModal: {
        type: Boolean,
        required: true,
    },
});

const form = useForm({ tagname: props.data.name });
</script>

<template>
    <tr class="hover:bg-gray-100 transition-colors group border-t border-gray-200">
        <td class="py-4 text-center px-2">{{ data.name }}</td>
         <td v-if="data.slug" class="py-4 text-center px-2">{{ data.slug  }}</td> 
        <td class="py-4 text-center">
            <div class="flex justify-center">
                <button
                    @click="showEditModal = true"
                    class="cursor-pointer m-1 pt-1"
                >
                    <PencilIcon class="h-4 w-4" />
                </button>
                <button
                    @click="showDeleteModal = true"
                    class="cursor-pointer m-1 pt-1"
                >
                    <TrashIcon class="h-4 w-4" />
                </button>
            </div>
        </td>
    </tr>

    <Modal
        :open="showDeleteModal"
        :title="`Do you want to delete this ${props.name}`"
    >
        <template #body>
            <div class="flex justify-center">
                <button
                    @click="handleDelete(data)"
                    class="btn-primary mr-2"
                >
                    Yes
                </button>
                <button
                    @click="showDeleteModal = false"
                    class="btn-primary bg-red-500"
                >
                    No
                </button>
            </div>
        </template>
    </Modal>

    <Modal :open="showEditModal">
        <template #body>
            <div>
                <label for="tag">Tag Name</label>
                <input
                    type="text"
                    name="tag"
                    id="tag"
                    class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.tagname"
                />
            </div>
            <div class="flex justify-center">
                <button
                    @click="handleEdit(data, form.tagname)"
                    class="btn-primary mr-2"
                >
                    Confirm
                </button>
                <button
                    @click="showEditModal = false"
                    class="btn-primary bg-red-500"
                >
                    Close
                </button>
            </div>
        </template>
    </Modal>
</template>
