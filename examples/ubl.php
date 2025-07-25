<?php

/**
 * Peppyrus accepts different types of documents. 
 * To create these documents, you must rely on other packages
 * For this test, we make use of https://github.com/num-num/ubl-invoice
 * It can be installed using composer: 
 *     composer require num-num/ubl-invoice
 */


/**
 * Create a test UBL invoice
 *
 * @return $xml_string
 */
function create_invoice(): string {
	// Address country
	$country = (new \NumNum\UBL\Country())
		->setIdentificationCode('BE');

	// Full address
	$address = (new \NumNum\UBL\Address())
		->setStreetName('Korenmarkt')
		->setBuildingNumber(1)
		->setCityName('Gent')
		->setPostalZone('9000')
		->setCountry($country);

	// Supplier company node
	$supplierCompany = (new \NumNum\UBL\Party())
		->setName('Supplier Company Name')
		->setPhysicalLocation($address)
		->setPostalAddress($address);

	// Client contact node
	$clientContact = (new \NumNum\UBL\Contact())
		->setName('Client name')
		->setElectronicMail('email@client.com')
		->setTelephone('0032 472 123 456')
		->setTelefax('0032 9 1234 567');

	// Client company node
	$clientCompany = (new \NumNum\UBL\Party())
		->setName('My client')
		->setPostalAddress($address)
		->setContact($clientContact);

	$legalMonetaryTotal = (new \NumNum\UBL\LegalMonetaryTotal())
		->setPayableAmount(10 + 2)
		->setAllowanceTotalAmount(0);

	// Tax scheme
	$taxScheme = (new \NumNum\UBL\TaxScheme())
		->setId(0);

	// Product
	$productItem = (new \NumNum\UBL\Item())
		->setName('Product Name')
		->setDescription('Product Description')
		->setSellersItemIdentification('SELLERID');

	// Price
	$price = (new \NumNum\UBL\Price())
		->setBaseQuantity(1)
		->setUnitCode(\NumNum\UBL\UnitCode::UNIT)
		->setPriceAmount(10);

	// Invoice Line tax totals
	$lineTaxTotal = (new \NumNum\UBL\TaxTotal())
		->setTaxAmount(2.1);

	// InvoicePeriod
	$invoicePeriod = (new \NumNum\UBL\InvoicePeriod())
		->setStartDate(new \DateTime());

	// Invoice Line(s)
	$invoiceLines = [];

	$orderLineReference = (new \NumNum\UBL\OrderLineReference)
		->setLineId('#ABC123');

	$invoiceLines[] = (new \NumNum\UBL\InvoiceLine())
		->setId(0)
		->setItem($productItem)
		->setInvoicePeriod($invoicePeriod)
		->setPrice($price)
		->setTaxTotal($lineTaxTotal)
		->setInvoicedQuantity(1)
		->setOrderLineReference($orderLineReference);

	$invoiceLines[] = (new \NumNum\UBL\InvoiceLine())
		->setId(0)
		->setItem($productItem)
		->setInvoicePeriod($invoicePeriod)
		->setPrice($price)
		->setAccountingCost('Product 123')
		->setTaxTotal($lineTaxTotal)
		->setInvoicedQuantity(1)
		->setOrderLineReference($orderLineReference);

	$invoiceLines[] = (new \NumNum\UBL\InvoiceLine())
		->setId(0)
		->setItem($productItem)
		->setInvoicePeriod($invoicePeriod)
		->setPrice($price)
		->setAccountingCostCode('Product 123')
		->setTaxTotal($lineTaxTotal)
		->setInvoicedQuantity(1)
		->setOrderLineReference($orderLineReference);


	// Total Taxes
	$taxCategory = (new \NumNum\UBL\TaxCategory())
		->setId(0)
		->setName('VAT21%')
		->setPercent(.21)
		->setTaxScheme($taxScheme);

	$taxSubTotal = (new \NumNum\UBL\TaxSubTotal())
		->setTaxableAmount(10)
		->setTaxAmount(2.1)
		->setTaxCategory($taxCategory);


	$taxTotal = (new \NumNum\UBL\TaxTotal())
		->addTaxSubTotal($taxSubTotal)
		->setTaxAmount(2.1);

	// Invoice object
	$invoice = (new \NumNum\UBL\Invoice())
		->setId(1234)
		->setCopyIndicator(false)
		->setIssueDate(new \DateTime())
		->setAccountingSupplierParty($supplierCompany)
		->setAccountingCustomerParty($clientCompany)
		->setSupplierAssignedAccountID('10001')
		->setInvoiceLines($invoiceLines)
		->setLegalMonetaryTotal($legalMonetaryTotal)
		->setTaxTotal($taxTotal);

	// Test created object
	// Use \NumNum\UBL\Generator to generate an XML string
	$generator = new \NumNum\UBL\Generator();
	$xml_string = $generator->invoice($invoice);
	return $xml_string;
}
