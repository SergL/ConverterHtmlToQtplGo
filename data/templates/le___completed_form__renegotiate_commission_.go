

//{% code
    type InputData struct {
        Key         string;
        Nameinput   string;
        Typeinput   string;
        Title       string;
        Val         string;
        Placeholder string;
    }
                    
    type TextareaData struct {
        Key         string;
        Name        string;
        Typeinput   string;
        Title       string;
        Val       string;
        Placeholder string;
    }

    type CheckboxData struct {
        Name        string;
        Key         string;
        Typeinput   string;
        Val         string;
        Title       string;
        Idx         int; 
        Checked     string;
        Events      string; 
        DataJson    string;
    }
    
    type DataHtml struct{
        Checkboxs   []CheckboxData;
        Inputs      []InputData;
        Textareas   []TextareaData;
    }
//%}



           package templates

         var DataLe___completed_form__renegotiate_commission_ = DataHtml{
    Inputs: []InputData{
          InputData{ Key: "u2159_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u2160_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u2161_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
    },
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u2317_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
}
