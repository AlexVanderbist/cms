<template>

    <button class="bard-toolbar-button" :class="{ active }" v-tooltip="button.text"  @click="editor.commands[button.command](button.args)">
        <svg-icon :name="button.svg" v-if="button.svg"></svg-icon>
        <div class="flex items-center" v-html="button.html" v-if="button.html"></div>
    </button>

</template>

<script>
export default {

    props: {
        button: Object,
        active: Boolean,
        config: Object,
        bard: {},
        editor: {}
    }

}
</script>
