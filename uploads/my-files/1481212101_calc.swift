//
//  ViewController.swift
//  Calculator Assignment
//
//  Created by Ramon Quiusky on 3/23/16.
//  Copyright © 2016 Chimi Coco. All rights reserved.
//

import UIKit

class ViewController: UIViewController {

    @IBOutlet weak var displayLabel: UILabel!
    
    var displayValue: String?
    var operand1: Double = 0.0
    var operand2: Double = 0.0
    var operationType: String = ""
    var operatorTypePreviouslyTapped: Bool = false
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        
        // initialize our dispaly value to the original value which is 0
        displayValue = displayLabel.text ?? "0"
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    
    // number actions

    @IBAction func zeroTapped(sender: UIButton) {
        
//        if let currentValue = displayValue {
//            displayValue = currentValue + "0"
//        }
        
        if displayValue != "0" {
            addTappedNumberToDisplayValue("0")
        }
        
    }
    
    @IBAction func oneTapped(sender: UIButton) {
        addTappedNumberToDisplayValue("1")
    }
    
    @IBAction func twoTapped(sender: UIButton) {
        addTappedNumberToDisplayValue("2")
    }
    
    @IBAction func threeTapped(sender: UIButton) {
        addTappedNumberToDisplayValue("3")
    }
    
    @IBAction func fourTapped(sender: UIButton) {
        addTappedNumberToDisplayValue("4")
    }
    
    @IBAction func fiveTapped(sender: UIButton) {
        addTappedNumberToDisplayValue("5")
    }
    
    @IBAction func sixTapped(sender: UIButton) {
        addTappedNumberToDisplayValue("6")
    }
    
    @IBAction func sevenTapped(sender: UIButton) {
        addTappedNumberToDisplayValue("7")
    }
    
    @IBAction func eightTapped(sender: UIButton) {
        addTappedNumberToDisplayValue("8")
    }
    
    @IBAction func nineTapped(sender: UIButton) {
        addTappedNumberToDisplayValue("9")
    }
    
    // add the digit to the displayValue and displayLabel
    func addTappedNumberToDisplayValue(tappedNumber: String) {
        
        // remove the leading 0 if it exists
        if displayValue == "0" {
            displayValue = ""
        }
        
        // append the tapped number to the displayValue and displayLabel
        displayValue = displayValue! + tappedNumber
        displayLabel.text = displayValue
        
        operatorTypePreviouslyTapped = false
    }
    
    
    // decimal, backspace actions
    
    @IBAction func decimalButtonTapped(sender: UIButton) {
        
//        // unwrap the optional implicitly
//        if let currentValue = displayValue {
//            displayValue = currentValue + "."
//        
//        // else if displayValue is nill (nothing entered yet), make it "0"
//        } else {
//            displayValue = "0."
//        }
        
        
        // add a decimal point only if it does not exist already
        if (displayValue!.rangeOfString(".") == nil) {
            
            if displayValue == "" {
                displayValue = "0"
            }
            
            displayValue = displayValue! + "."
            displayLabel.text = displayValue
        }
    }

    @IBAction func backspaceTapped(sender: UIButton) {
        /*displayValue = "0"
        displayLabel.text = "0"
        operand1 = 0.0
        operand2 = 0.0
        print("\n\n*************\n\n")*/
        
        //print(formatDisplayLabelString(Double(displayValue!)!))
        
        if (displayValue != "0") {
            
            var tmpDisplayValue = ""
            
            if (displayValue != "-") {
                tmpDisplayValue = String(formatDisplayLabelString(Double(displayValue!)!))
                tmpDisplayValue.removeAtIndex(tmpDisplayValue.endIndex.predecessor())
            }
            
            
            displayValue = tmpDisplayValue
            
            if displayValue == "" {
                displayValue = "0"
            }
            
            displayLabel.text = displayValue
            
        }
    }
    
    
    // operations actions
    
    @IBAction func plusMinusTapped(sender: UIButton) {
        
        if let currentValue = displayValue {
            
            var tmpDisplayValue = Double(currentValue)!
            if tmpDisplayValue != 0 {
                tmpDisplayValue *= -1;
                displayValue = String(tmpDisplayValue)
                displayLabel.text = formatDisplayLabelString(tmpDisplayValue)
            }
            
        }
        
    }
    
    @IBAction func minusTapped(sender: UIButton) {
        setOperationTypeString("-")
    }
    
    @IBAction func plusTapped(sender: UIButton) {
        setOperationTypeString("+")
    }
    
    @IBAction func multiplyTapped(sender: UIButton) {
        setOperationTypeString("*")
    }
    
    @IBAction func divideTapped(sender: UIButton) {
        setOperationTypeString("/")
    }
    
    func setOperationTypeString(operationTypeString: String) {
        
        
        if (!operatorTypePreviouslyTapped) {
            
            operatorTypePreviouslyTapped = true
        
            // if there is already an operand, means that an operator button was tapped
            // need to calculate before proceeding
            var operand1Reset: Bool = false
            if operand1 > 0 {
               // operand2 = Double(displayValue!)!
                //var previousOperationTypeString: String = operationType
                let rightOperand = Double(displayValue!)! ?? 0.0
                
                operand1 = performOperation(operationType, leftOperand: operand1, rightOperand: rightOperand)
                operand1Reset = true
                
                //displayLabel.text = String(operand1)
                displayLabel.text = formatDisplayLabelString(operand1)
            }
            
            // get the operation type
            operationType = operationTypeString
            
            if (!operand1Reset) {
                operand1 = Double(displayValue!)!
            }
            
            displayValue = ""
        }
        
    }
    
    func formatDisplayLabelString(displayLabelValue: Double) -> String {
        let result = String(format: "%g", displayLabelValue)
        return result
    }
    
    func performOperation(operationTypeString: String, leftOperand: Double, rightOperand: Double) -> Double {
        
        var result: Double = 0.0
        
        //operand2 = Double(displayValue!)!
        
        if operationTypeString == "*" {
            
            result = leftOperand * rightOperand
            
        } else if operationTypeString == "/" {
            
            if rightOperand == 0 {
                displayLabel.text = "error"
            }
            
            result = leftOperand / rightOperand
            
        } else if operationTypeString == "+" {
            
            result = leftOperand + rightOperand
            
        } else if operationTypeString == "-" {
            
            result = leftOperand - rightOperand
            
        }
        
        return result
    }
    
    @IBAction func equalTapped(sender: UIButton) {
        
        //var result = performOperation()
//        operand2 = Double(displayValue!)!
//        
//        if operationType == "*" {
//            
//            result = operand1 * operand2
//            
//        } else if operationType == "/" {
//            
//            if operand2 == 0 {
//                displayLabel.text = "error"
//                return
//            }
//
//            result = operand1 / operand2
//            
//        } else if operationType == "+" {
//            
//            result = operand1 + operand2
//            
//        } else if operationType == "-" {
//            
//            result = operand1 - operand2
//            
//        }
    
        // set the result
        let result = performOperation(operationType, leftOperand: operand1, rightOperand: Double(displayValue!)!)
        //displayValue = String(result)
        //displayLabel.text = displayValue
        displayLabel.text = formatDisplayLabelString(result)
        
        // now unset the operands so we begin anew
        operand1 = 0.0
        operand2 = 0.0
        
    }
}

