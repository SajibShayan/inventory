<script setup>
import { ref } from "vue";
import {
  Bars3Icon,
  FolderIcon,
  HomeIcon,
  FilmIcon,
  UsersIcon,
  BanknotesIcon,
  SquaresPlusIcon,
  TagIcon,
  BookmarkSquareIcon,
  GiftIcon,
  EnvelopeIcon,
  InboxStackIcon,
  ViewColumnsIcon,
  Cog6ToothIcon,
  CurrencyYenIcon,
  PhotoIcon,
  ShoppingCartIcon,
  BriefcaseIcon,
  Square3Stack3DIcon,
  StarIcon,
  QueueListIcon,
  ChatBubbleBottomCenterTextIcon,
  ChatBubbleLeftRightIcon,
  MapIcon,
} from "@heroicons/vue/24/outline";
import { useParentRouteName } from "@/Composable/fetch";
import { router } from "@inertiajs/vue3";

// const location = useRoute();

const navigation = ref([
  {
    name: "Inventory",
    href: "inventory:index",
    icon: HomeIcon,
    current: true,
  },
  {
    name: "Items",
    href: "items:index",
    icon: Square3Stack3DIcon,
    current: true,
  },
]);
</script>

<template>
  <!-- give the sidebar z-50 class so its higher than the navbar if you want to see the logo -->
  <!-- you will need to add a little "X" button next to the logo in order to close it though -->
  <div
    class="overflow-y-auto min-h-0 w-1/2 md:w-1/3 lg:w-64 fixed md:top-0 md:left-0 h-screen lg:block bg-gray-100 border-r z-30"
    :class="sideBarOpen ? '' : 'hidden'" id="main-nav">
    <div class="w-full h-20 border-b flex px-4 items-center mb-8">
      <p class="font-semibold text-3xl text-blue-400 pl-4">LOGO</p>
    </div>

    <div class="mb-4 px-4">
      <div v-for="item in navigation" :key="item.name" @click="
      router.get(
        route(item.href),
        {},
        { preserveState: true }
      )
      "
        class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer" 
        :class="route().current(item.href) ||
      useParentRouteName(item.href) ===
      useParentRouteName(route().current()) ? 'bg-gray-200' : ''">

        <component :is="item.icon" class="mr-2 flex-shrink-0 h-6 w-6" aria-hidden="true" />
        <span class="text-gray-700">{{ item.name }}</span>
      </div>
    </div>
  </div>
</template>
