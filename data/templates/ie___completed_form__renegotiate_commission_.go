

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

         var DataIe___completed_form__renegotiate_commission_ = DataHtml{
    Inputs: []InputData{
          InputData{ Key: "u4027_input", Typeinput: "text", Val: "7712 12254 3466", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4028_input", Typeinput: "text", Val: "ИВАНОВ ИВАН ИЛЬИЧ", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4029_input", Typeinput: "text", Val: "ИП ИВАНОВ ИВАН ИЛЬИЧ", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4030_input", Typeinput: "text", Val: "115280, Г.МОСКВА, УЛ. АВИАМОТОРНАЯ, 44, КВ.12", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4031_input", Typeinput: "text", Val: "1246 7636 7242 6546 46", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4032_input", Typeinput: "text", Val: "434 734 726", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4033_input", Typeinput: "text", Val: "СБЕРБАНК РОССИИ", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4034_input", Typeinput: "text", Val: "4080 3723 5355 7778 3552", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4035_input", Typeinput: "text", Val: "3488 1769 9999 433 7655", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4036_input", Typeinput: "text", Val: "РОССИЙСКИЙ РУБЛЬ", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4037_input", Typeinput: "text", Val: "РОССИЯ", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
    },
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u4063_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
}
