<template>
  <q-field>
    <template v-slot:control="{ id, floatingLabel, modelValue, emitValue }">
      <money3
        :id="id"
        class="q-field__input text-left"
        :model-value="modelValue"
        @update:model-value="(v) => extendEmitFn(emitValue, v)"
        v-bind="config"
        v-show="floatingLabel"
      />
    </template>
  </q-field>
</template>

<script>
import { defineComponent } from 'vue'
import { Money3Component as Money3 } from 'v-money3'
import { debounce } from 'quasar';

export default defineComponent({
  name: 'InputMoney',
  components: {
    Money3
  },
  props: {
    debounce: {
      type: [Number, String],
      default: 0,
    },
    prefix: {
      type: String,
      default: 'R$ ',
    },
    suffix: {
      type: String,
      default: '',
    },
    precision: {
      type: Number,
      default: 2
    },
    max: {
      type: Number,
      default: null
    }
  },
  setup (props, { emit }) {
    const config = {
      decimal: ',',
      thousands: '.',
      prefix: props.prefix,
      suffix: props.suffix,
      precision: props.precision,
      masked: false,
      focusOnRight: true,
      max: props.max,
    }

    const extendEmitFn = debounce((emitValueFn, value) => {
      emitValueFn(value);
      emit('change', value);
    }, parseInt(props.debounce))

    return {
      config,
      extendEmitFn,
    }
  }
})
</script>