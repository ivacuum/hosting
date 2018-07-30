import ModelProvide from '../../../mixins/ModelProvide'
import ModelFieldTrans from '../../../mixins/ModelFieldTrans'

const model = 'Country'

export default {
  mixins: [ModelFieldTrans, ModelProvide],

  data() {
    return {
      modelPlural: window.singularAndPluralForms[model].plural,
      modelSingular: window.singularAndPluralForms[model].singular,
    }
  },
}
