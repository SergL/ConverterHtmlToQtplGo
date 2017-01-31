

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

         var DataLe___step_2__legal_info_ = DataHtml{
    Inputs: []InputData{
          InputData{ Key: "u3254_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u3259_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u3260_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u3271_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u3272_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u3273_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u3274_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
    },
}
