

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

         var DataPp___completed_form__renegotiate_commission_ = DataHtml{
    Inputs: []InputData{
          InputData{ Key: "u1827_input", Typeinput: "text", Val: "ИВАНОВ ИВАН ИЛЬИЧ", Title: "Введите Ваше Фамилию Имя Отчество", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1828_input", Typeinput: "text", Val: "ME 900099", Title: "Введите серию и номер Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1829_input", Typeinput: "text", Val: "16.08.2013", Title: "Введите число выдачи Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1830_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1832_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1838_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1955_input", Typeinput: "text", Val: "3123 6543 2225", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
    },
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u1909_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
}
