<script setup>
// import { useImageUrl } from "@/Composable/fetch.js";
// import { timeAgo } from "@/Composable/date.js";
import {
    CheckCircleIcon,
    XCircleIcon,
    PencilSquareIcon,
    TrashIcon,
    ChatBubbleLeftEllipsisIcon,
    PlayCircleIcon,
} from "@heroicons/vue/24/outline";
import { router } from "@inertiajs/vue3";
import { reactive } from "vue";
import CustomModal from "./CustomModal.vue";
// import VideoPlay from "@/Components/UploadModal/VideoPlay.vue";

const props = defineProps({
    video: Object,
});

const state = reactive({
    videoPlayModal: false,
    video: {},
});

const onSubmit = (slug, status) => {
    router.put(route("admin:video:update", { video: slug }), {
        status: status,
    });
};

const handleClose = () => {
    state.videoPlayModal = false;
};
</script>

<template>
    <td
        class="flex flex-col sm:flex-row gap-x-2 py-1 lg:gap-x-4 lg:py-4 px-2 items-center lg:px-4 group"
    >
        <div
            class="relative min-w-[150px] max-w-[150px] aspect-[3/2] transition-all duration-500 group-hover:scale-110 cursor-pointer"
        >
            <img
                :src="video.image"
                class="w-full h-full rounded-lg object-cover object-top"
            />

        </div>
        <div class="text-left">
            <a
                href="#"
                class="text-sm md:text-base font-semibold text-gray-700"
            >
                {{ video.name }}
            </a>
        </div>
    </td>
    <td class="table-text-style">
        {{ video?.inventory?.name}}
    </td>
    <td class="table-text-style">
        {{ video.description}}
    </td>
    <td class="table-text-style">
        {{ video.quantity }}
    </td>
    <td class="text-end text-md">
        <div
            class="flex-col flex justify-center items-center gap-2"
        >
            <button class="btn-primary w-28 px-2">
                <div class="flex justify-center items-center w-full">
                    <PencilSquareIcon class="h-5 w-5 text-white mr-1" />
                    Edit
                </div>
            </button>
            <button class="btn-danger px-2 w-28">
                <div class="flex justify-center items-center w-full">
                    <TrashIcon class="h-5 w-5 text-white mr-1" />
                    Delete
                </div>
            </button>
        </div>

    </td>

    <!-- <CustomModal
        :open="showDeleteModal"
        :title="`Do you want to delete this ${props.name}`"
    >
        <template #body>
            <div class="flex justify-center gap-3">
                <button
                    @click="showDeleteModal = false"
                    class="btn-primary bg-red-500"
                >
                    No
                </button>

                <button
                    @click="handleDelete(data)"
                    class="btn-primary mr-2"
                >
                    Yes
                </button>
            </div>
        </template>
    </CustomModal>

    <CustomModal :open="showEditModal">
        <template #body>
            <div>
                <label for="tag">Name</label>
                <input
                    type="text"
                    name="tag"
                    id="tag"
                    class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.name"
                />
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors?.name" class="text-center mb-4" v-text="errors?.name"></p>
            </div>
            <div>
                <label for="tag">Description</label>
                <textarea
                    type="text"
                    name="tag"
                    id="tag"
                    class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.description"
                />
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors?.description" class="text-center mb-4" v-text="errors?.description"></p>
            </div>
            <div class="flex justify-center gap-3">
                <button
                    @click="showEditModal = false"
                    class="btn-primary bg-red-500"
                >
                    Close
                </button>

                <button
                    @click="handleEdit(data, form)"
                    class="btn-primary"
                >
                    Confirm
                </button>
            </div>
        </template>
    </CustomModal> -->

</template>
